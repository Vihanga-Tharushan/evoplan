<?php
    class M_ratings {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //Add a rating
        public function addRating($data){
            $this->db->query("INSERT INTO ratings (service_provider_id, user_id, rating, review) VALUES (:service_provider_id, :user_id, :rating, :review)");
            // Bind values
            $this->db->bind(':service_provider_id', $data['service_provider_id']);
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':rating', $data['rating']);
            $this->db->bind(':review', $data['review']);
           
             // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        //Get ratings summary for a service provider
        public function getRatingsSummary($service_id){
            $this->db->query("SELECT 
                :service_id AS service_id,
                COUNT(r.rating) AS total_reviews,
                ROUND(SUM(CASE WHEN r.rating = 5 THEN 1 ELSE 0 END) / NULLIF(COUNT(r.rating), 0) * 100, 1) AS five_star_percentage,
                ROUND(SUM(CASE WHEN r.rating = 4 THEN 1 ELSE 0 END) / NULLIF(COUNT(r.rating), 0) * 100, 1) AS four_star_percentage,
                ROUND(SUM(CASE WHEN r.rating = 3 THEN 1 ELSE 0 END) / NULLIF(COUNT(r.rating), 0) * 100, 1) AS three_star_percentage,
                ROUND(SUM(CASE WHEN r.rating = 2 THEN 1 ELSE 0 END) / NULLIF(COUNT(r.rating), 0) * 100, 1) AS two_star_percentage,
                ROUND(SUM(CASE WHEN r.rating = 1 THEN 1 ELSE 0 END) / NULLIF(COUNT(r.rating), 0) * 100, 1) AS one_star_percentage,
                COALESCE(ROUND(AVG(r.rating), 1), 0) AS average_rating
            FROM reviews r
            WHERE r.service_id = :service_id
            GROUP BY r.service_id
            UNION ALL
            SELECT 
                :service_id AS service_id,
                0 AS total_reviews,
                0 AS five_star_percentage,
                0 AS four_star_percentage,
                0 AS three_star_percentage,
                0 AS two_star_percentage,
                0 AS one_star_percentage,
                0 AS average_rating
            WHERE NOT EXISTS (SELECT 1 FROM reviews WHERE service_id = :service_id)
            LIMIT 1");
    
            $this->db->bind(':service_id', $service_id);
            return $this->db->single();
        }

       //this is for analystics

       public function getRatingsforServiceProvider($service_id){

        $this->db->query("SELECT r.*, CONCAT(u.fname, ' ', u.lname) AS reviewer_name FROM reviews r JOIN users u ON r.user_id = u.user_id WHERE r.service_id = :service_id ORDER BY r.created_at DESC");
        $this->db->bind(':service_id', $service_id);
        return $this->db->resultSet();

       }

       public function getAllRatings(){
            
            $this->db->query("SELECT 
                                     sp.service_id,
                                     CONCAT(sp.fname, ' ', sp.lname) AS provider_name,
                                     AVG(r.rating) AS avg_rating,
                                     COUNT(r.review_id) AS total_reviews
                                    FROM service_providers sp
                                    LEFT JOIN reviews r
                                    ON sp.service_id = r.service_id
                                    GROUP BY sp.service_id, provider_name
                                    ORDER BY avg_rating DESC;");
            return $this->db->resultSet();

       }

       // Get count of reviews for each rating (1-5 stars)
       public function getReviewCountByRating($service_id){
            $this->db->query("SELECT 
                                1 AS rating,
                                COUNT(CASE WHEN r.rating = 1 THEN 1 END) AS count
                            FROM reviews r
                            WHERE r.service_id = :service_id
                            UNION ALL
                            SELECT 
                                2 AS rating,
                                COUNT(CASE WHEN r.rating = 2 THEN 1 END)
                            FROM reviews r
                            WHERE r.service_id = :service_id
                            UNION ALL
                            SELECT 
                                3 AS rating,
                                COUNT(CASE WHEN r.rating = 3 THEN 1 END)
                            FROM reviews r
                            WHERE r.service_id = :service_id
                            UNION ALL
                            SELECT 
                                4 AS rating,
                                COUNT(CASE WHEN r.rating = 4 THEN 1 END)
                            FROM reviews r
                            WHERE r.service_id = :service_id
                            UNION ALL
                            SELECT 
                                5 AS rating,
                                COUNT(CASE WHEN r.rating = 5 THEN 1 END)
                            FROM reviews r
                            WHERE r.service_id = :service_id
                            ORDER BY rating");
            $this->db->bind(':service_id', $service_id);
            $results = $this->db->resultSet();
            
            // Format as array with rating as key
            $formatted = [];
            foreach($results as $row){
                $formatted[(string)$row->rating] = (int)$row->count;
            }
            return $formatted;
       }


        

       //this is for analystics

       public function getAllRatingsToAdmin(){
            
        $this->db->query("SELECT 
                                 r.review_id,
                                 u.name AS reviewer_name,
                                 u.profile_pic,
                                 CONCAT(sp.fname, ' ', sp.lname) AS provider_name,
                                 r.rating,
                                 r.review_text,
                                 r.created_at
                                FROM reviews r
                                JOIN clients u ON r.client_id = u.client_id
                                JOIN service_providers sp ON r.service_id = sp.service_id
                                ORDER BY r.created_at DESC;");
        return $this->db->resultSet();
       }

       public function deleteRating($rating_id){
            $this->db->query("DELETE FROM reviews WHERE review_id = :rating_id");
            $this->db->bind(':rating_id', $rating_id);
            return $this->db->execute();
       }
    }

