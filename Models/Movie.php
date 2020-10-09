<?php
    namespace Models;

    class Movie
    {

        private $popularity; 
        private $vote_count;
        private $video;
        private $id;
        private $adult;
        private $backdrop_path;
        private $original_language;
        private $original_title;
        private $title;
        private $overview;

        public function __construct($populariy,$vote_count,$video, $id, $adult, $backdrop_path,
                                    $original_language, $original_title, $title, $overview)
        {
            $this->popularity = $populariy;
            $this->vote_count = $vote_count;
            $this->video = $video;
            $this->id = $id;
            $this->adult = $adult;
            $this->backdrop_path = $backdrop_path;
            $this->original_language = $original_language;
            $this->original_title = $original_title;
            $this->title = $title;
            $this->overview = $overview;
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

        public function getVideo()
        {
                return $this->video;
        }

        public function setVideo($video)
        {
                $this->video = $video;
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

        public function getBackdrop_path()
        {
                return $this->backdrop_path;
        }

        public function setBackdrop_path($backdrop_path)
        {
                $this->backdrop_path = $backdrop_path;
        }

        public function getOriginal_language()
        {
                return $this->original_language;
        }

        public function setOriginal_language($original_language)
        {
                $this->original_language = $original_language;
        }

        public function getOriginal_title()
        {
                return $this->original_title;
        }

        public function setOriginal_title($original_title)
        {
                $this->original_title = $original_title;
        }

        public function getTitle()
        {
                return $this->title;
        }

        public function setTitle($title)
        {
                $this->title = $title;
        }

        public function getOverview()
        {
                return $this->overview;
        }

        public function setOverview($overview)
        {
                $this->overview = $overview;
        }
    }   