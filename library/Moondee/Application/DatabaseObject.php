<?php

/**
 * Abstrakcyjna klasa dla wszystkich obiektów które mają odpowiedniki w bazie danych
 *
 * @package    Moondee_Application
 */

abstract class Moondee_Application_DatabaseObject
{
	/**
     * Id obiektu
     * 
     * @var integer
     */
    public $id = null;

    /**
     * Model obiektu
	 * 
	 * @var mixed
     */
    protected $model = null;

    /**
     * Model obiektu
	 * 
	 * @var Zend_Db_Table_Row
     */
    protected $database_object_row = null;
	

	/**
     * Tworzy obiekt na podstawie ID lub danych z parametru
     *
     * Jeśli w parametr $data jest typu id pobierane są dane z bazy danych i obiekt wypełniany jest tymi danymi
     * Jeśli parametr $data jest tablicą obiekt wypełniany jest danymi z tej tablicy
     *
     * @param  integer|array $data Id obiektu lub tablica danych obiektu
     * @return void
     */    
    public function __construct( $data = null ){
        if( $data != null ){
            if( is_int( $data ) ){
                if( !$this->setFromDatabase( $data ) ){
                    unset( $this );
		}
            }else{
                $this->setFromData( $data );
            }
        }
    }

    /**
     * Przypisuje zmiennej "model" model obiektu
     *
     * @return void
     */ 
    abstract protected function setModel();

    /**
     * Zwraca modle obiektu
     *
     * @return mixed
     */ 
    public function getModel(){
        if( $this->model == null ){
            $this->setModel();
        }
        
        return $this->model;
    }
    
    /**
     * Wypełnienie obiektu danymi z bazy danych
     *
     * @param  integer $object_id Id object
     * @return bool
     */   
    protected function setFromDatabase( $object_id ){
        $model = $this->getModel();
        $objectData = $model->find( $object_id )->current();
		
        if( !$objectData ){
            return false;
        }
        
        $this->setFromData( $objectData );
        return true;
    }
	
	/**
     * Wypełnienie obiektu danymi z parametru
     *
     * @param  array $objectData
     * @return void
     */ 
    protected function setFromData( $objectData ){
        if( $objectData ){
            if( is_object( $objectData ) && 'Zend_Db_Table_Row' == get_class( $objectData ) ){
                $this->setDatabaseObjectRow( $objectData );
            }
			
            foreach ( $objectData as $key => $value ){
                $this->$key = $value;
            }
        }
    }

    /**
     * Zwraca wiersz z bazy danych bierzącego obiektu
     * 
     * Zwraca wiersz z bazy danych bierzącego obiektu. Jeśli nie ma parametru id, 
     * czyli obiektu nie ma jeszcze w bazie danych, zwracany jest pusty nowy wiersz
     *
     * @return Zend_Db_Table_Row
     */ 
    protected function getDatabaseObjectRow(){
        if( !$this->database_object_row ){
                $this->setDatabaseObjectRow();
        }

        return $this->database_object_row;
    }

    /**
     * Ustawia wiersz z bazy danych bierzącego obiektu
     * 
     * Ustawia wiersz z bazy danych bierzącego obiektu. Jeśli nie ma parametru id, 
     * czyli obiektu nie ma jeszcze w bazie danych, ustawiany jest pusty nowy wiersz
     *
	 * @param  Zend_Db_Table_Rowset $row
     * @return void
     */ 
    protected function setDatabaseObjectRow( $row = null ){
        if( $row ){
                $this->database_object_row = $row;
        }else{
            $model = $this->getModel();

            if( $this->id ){
                $row = $model->find( $this->id )->current();
            }else{
                $row = $model->createRow();
            }

            $this->database_object_row = $row;
        }
    }

    /**
     * Zwraca zmienne obiektu pokrywajace się z danymi z tabeli (tabela w której przechowywane sa dane obiektu) bazy danych
     *
     * @return array
     */ 
    protected function getObjectData(){
		$object_row = $this->getDatabaseObjectRow();
        $object_data = array();

        foreach( $object_row as $key => $value ){
            if( !$this->$key ){
                $object_data[$key] = '';
            }else{
                $object_data[$key] = $this->$key;
            }
        }
        
        return $object_data;
    }

    /**
     * Zapisuje obiekt do bazy danych
     *
     * @return integer
     */ 
    public function save(){
        $object_row = $this->getDatabaseObjectRow();  
        
        $object_data = $this->getObjectData();
        
        $object_row->setFromArray( $object_data );  
		
        $this->id = (int) $object_row->save();
        
        return $this->id;
    }

    /**
     * Metoda zwraca id obiektu
     *
     * @return integer
     */ 
    public function getId(){
        return $this->id;
    }
}
?>