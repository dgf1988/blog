<?php

    //创建连接数据库的字符串。
    function mydb_make_connect_sql($host, $dbname, $charset) {
        return "mysql:host=".$host.";dbname=".$dbname.";charset=".$charset;
    }

    function mydb_connect($host, $dbname, $charset, $user, $password) {
        return new PDO(mydb_make_connect_sql("localhost", "ding", "utf8"), $user, $password);
    }

    function mydb_value_sql($value) {
        if ($value == null) {
            return "NULL";
        } else if (is_string($value)) {
            return "'".$value."'";
        }
        return "'".(string)$value."'";
    }

    function mydb_tag_sql($tag) {
        return "`".$tag."`";
    }
    
    class MydbType {
        const NUM = 11;

        const CHAR = 21;
        const VARCHAR = 22;
        const TEXT = 23;
        const MEDIUMTEXT = 24;

        const DATA = 31;
        const DATETIME = 32;
        const TIMESTAMP = 33;

        public $name = "";
        public $lenght = 0;
        private $haslenght = true;

        function __construct ($mydbtype, $lenght=0) {
            if ($mydbtype == MydbType::NUM ) {
                $this->name = "INT";
                if ($lenght < 11) {
                    $lenght = 11;
                }
                $this->lenght = $lenght;
            }
            if ($mydbtype == MydbType::CHAR ) {
                $this->name = "CHAR";
                if ($lenght > 255) {
                    $lenght = 255;
                }
                $this->lenght = $lenght;
            }
            if ($mydbtype == MydbType::VARCHAR ) {
                $this->name = "VARCHAR";
                if ($lenght < 255) {
                    $lenght = 255;
                }
                $this->lenght = $lenght;
            }
            if ($mydbtype == MydbType::TEXT ) {
                $this->name = "TEXT";
                $this->haslenght = false;
            }
            if ($mydbtype == MydbType::MEDIUMTEXT ) {
                $this->name = "MEDIUMTEXT";
                $this->haslenght = false;
            }
            if ($mydbtype == MydbType::DATA ) {
                $this->name = "DATA";
                $this->haslenght = false;
            }
            if ($mydbtype == MydbType::DATETIME ) {
                $this->name = "DATETIME";
                $this->haslenght = false;
            }
            if ($mydbtype == MydbType::TIMESTAMP ) {
                $this->name = "TIMESTAMP";
                $this->haslenght = false;
            }
        }

        function to_sql () {
            if ($this->haslenght) {
                return $this->name."(".$this->lenght.")";
            }else {
                return $this->name;
            }
        }
    }
		
	class MydbColumn {
        public $num = 0;
        public $name = "";
        public $type = null;
        public $allowNull = false;
        public $default = null;
        public $hasDefault = false;
        public $isPrimarykey = false;
        public $isAutoIncrement = false;
        public $isUnique = false;
        public $isCurrentTimestamp = false;
		public $isOnUpdate = false;

		function __construct ($num, $name, $type) {
			$this->num = $num;
            $this->name = $name;
            $this->type = $type;
		}

        function to_sql() {
            $sqlitems = array();
            array_push($sqlitems, "`".$this->name."`", $this->type->to_sql());
            if (!$this->allowNull) {
                array_push($sqlitems, "NOT NULL");
            }
            if ($this->hasDefault) {
                array_push($sqlitems, "DEFAULT");
                if ($this->isCurrentTimestamp) {
                    array_push($sqlitems, "CURRENT_TIMESTAMP");
                } else {
                    array_push($sqlitems, mydb_value_sql($this->default));
                }
            }
            if ($this->isAutoIncrement) {
                array_push($sqlitems, "AUTO_INCREMENT");
            }
            if ($this->isOnUpdate) {
                array_push($sqlitems, "ON UPDATE CURRENT_TIMESTAMP");
            }
            return implode(" ", $sqlitems);
        }
	}

    class MydbTable {
        public $name = "";
        public $primarykey = "";
        public $engine = "MyISAM";
        public $charset = "utf8";
        public $columns = array();

		function __construct ($name, $primarykey = "id", $engine = "MyISAM", $charset = "utf8") {
			$this->name = $name;
            $this->primarykey = $primarykey;
            $this->engine = $engine;
            $this->charset = $charset;
		}

        function to_sql() {
            $sqlitems = array();
            array_push($sqlitems, "CREATE TABLE", mydb_tag_sql($this->name), "(");
            $colitems = array();
            foreach($this->columns as $col) {
                array_push($colitems, $col->to_sql());
            }
            array_push($colitems, "PRIMARY KEY (".mydb_tag_sql($this->primarykey).")");
            array_push($sqlitems, implode(",\n", $colitems), ")", "ENGINE=".$this->engine." DEFAULT CHARSET=".$this->charset);
            return implode(" ", $sqlitems);
        }
    }