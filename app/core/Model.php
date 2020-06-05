<?php

	Class Model
	{
		protected $db;

		function __construct()
		{
			$this->db 	= mysqli_connect(
											db_host,
											db_user,
											db_pass,
											db_name
										);

			return $this->db;
		}

		public function store($tabel,$data)
		{
			$r1 = array();
			$f1 = array();

			foreach($data as $f2=>$r2)
			{
				array_push($f1,$f2);
				array_push($r1,"'".$r2."'");
			}

			$field 	= implode(',',$f1);
			$row 	= implode(',',$r1);

			$query 	= $this->db->query("INSERT INTO $tabel($field) VALUES ($row)");

			return $query;
		}
	
		public function update($id_name,$id,$tabel,$data)
		{
			$r1 	= array();

			foreach($data as $f=>$r)
			{
				array_push($r1,$f."="."'".$r."'");
			}

			$row 	= implode(',',$r1);

			$query 	= $this->db->query("UPDATE $tabel SET $row WHERE $id_name='$id'");

			return $query;
		}

		public function delete($id_name,$id,$table)
		{
			$query 	= $this->db->query("DELETE FROM $table WHERE $id_name='$id'");

			return $query;		
		}

		public function libs($lib)
		{
			$this->liblaries 	= $lib;

			require_once '../app/liblaries/' . $this->liblaries . '.php';

			return new $this->liblaries;
		}
	}