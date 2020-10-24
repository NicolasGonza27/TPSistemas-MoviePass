<?php
    namespace Models;

    class Movie
    {

        private $popularity; 
        private $vote_count;
        private $poster_path;
        private $id;
        private $adult;
        private $genre_ids;
        private $title;
        private $vote_average;
        private $overview;
        private $release_date;
        private $runtime;


        public function __construct($popularity,$vote_count,$poster_path, $id, $adult ,$genre_ids, $title,$vote_average, $overview,
                                    $release_date,$runtime)
        {
            $this->popularity = $popularity;
            $this->vote_count = $vote_count;
            $this->poster_path = $poster_path;
            $this->id = $id;
            $this->adult = $adult;
            $this->genre_ids = $genre_ids;
            $this->title = $title;
            $this->vote_average = $vote_average;
            $this->overview = $overview;
            $this->release_date = $release_date;
            $this->runtime = $runtime;
            
        }


        public function getPopularity()
        {
                return $this->popularity;
        }

        public function setPopularity($popularity)
        {
                $this->popularity = $popularity;
        }

        public function getVote_count()
        {
                return $this->vote_count;
        }

        public function setVote_count($vote_count)
        {
                $this->vote_count = $vote_count;

        }

        public function getPoster_path()
        {
                return $this->poster_path;
        }

        public function setPoster_path($poster_path)
        {
                $this->poster_path = $poster_path;
        }

        public function getId()
        {
                return $this->id;
        }


        public function setId($id)
        {
                $this->id = $id;
        }

        public function getAdult()
        {
                return $this->adult;
        }

        public function setAdult($adult)
        {
                $this->adult = $adult;

        }

        public function getAllGenre_ids()
        {
                return $this->genre_ids;
        }

        public function exists_gender_id($idToSearch)
        {       
                foreach($this->getAllGenre_ids() as $id)
                {       
                        if($idToSearch == $id)
                        {       
                                return $idToSearch;
                        }
                }

        return false;
        }

        public function setGenre_ids($genre_ids)
        {
                $this->genre_ids = $genre_ids;
        }

        public function getTitle()
        {
                return $this->title;
        }

        public function setTitle($title)
        {
                $this->title = $title;
        }

        public function getVote_average()
        {
                return $this->vote_average;
        }

        public function setVote_average($vote_average)
        {
                $this->vote_average = $vote_average;
        }

        public function getOverview()
        {
                return $this->overview;
        }

        public function setOverview($overview)
        {
                $this->overview = $overview;
        }

        public function getRelease_date()
        {       
                return $this->release_date;
        }

        public function setRelease_date($release_date)
        {
                $this->release_date = $release_date;
        }

        public function getImage()
        {
                return "https://image.tmdb.org/t/p/w500".$this->getPoster_path();
        }

        public function getRuntime()
        {
                return $this->runtime;
        }

        public function setRuntime($runtime)
        {
                $this->runtime = $runtime;
        }
}   