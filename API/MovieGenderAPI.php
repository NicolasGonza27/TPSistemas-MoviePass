<?php 

    namespace API;

    use Models\MovieGender as MovieGender;

    
    class MovieGenderAPI
        {
            private $movieGenderList;
            private $fileName;

            public function __construct()
            {
                $this->movieGenderList = array();
                $this->fileName = "https://api.themoviedb.org/3/genre/movie/list?api_key=241053b8db24b510787d177925c66cdb";
            }

            public function GetAll()
            {
                $this->RetrieveData();
                return $this->movieGenderList;
            }

            public function Get($name_gender)
            {   
                $this->RetrieveData();
                foreach($this->movieGenderList as $movieGender)
                {   

                    if($movieGender->getName() == $name_gender)
                    {
                        return $movieGender;
                    }
                }
            return false;
            }

            public function RetrieveData()
            {   
                    $this->movieGenderList = array();

                    $jsonContent = file_get_contents($this->fileName);
                    $contentArray = ($jsonContent) ? json_decode($jsonContent, true) : array();
                    
                    foreach($contentArray["genres"] as $content)
                    {     
                        $id = $content["id"]; 
                        $name = $content["name"];
                        
                        $movieGender = new MovieGender($id,$name);
                    
                        array_push($this->movieGenderList, $movieGender);
                    }

            }

        }   




?>