<?php

class Posts{
    private $table = "posts";
    private $post_author;
    private $post_id;
    private $post_category_id;
    private $post_title;
    private $post_body;
    private $post_tags;
    private $post_author_id;
    private $post_status;
    private $post_date;
    private $post_image;
    private $created_at;
    private $updated_at;
    private $conn;
    
    public function __construct($conn){
        $this->conn = $conn;
    }
    
    function createPost($data){
        $columnString = implode(", ", array_keys($data));
        $valueString = ":".implode(", :", array_keys($data));
        
        $sql = "INSERT INTO {$this->table} ({$columnString}) VALUES ({$valueString})";
        //echo $sql;
        
        $ps = $this->conn->prepare($sql);
        $result = $ps->execute($data);
        if($result){
            return $this->conn->lastInsertId();
        }
        else{
            return false;
        }
    }
    
    function updatePost($data, $condition){
        $i = 0;
        $columnValueSet = "";
        foreach($data as $key=>$value){
            $comma = ($i<count($data)-1?", ":"");
            $columnValueSet .= $key. "='".$value."'".$comma;
            $i++;
        }
        $sql = "UPDATE $this->table SET $columnValueSet WHERE $condition";
        
        $ps = $this->conn->prepare($sql);
        $result = $ps->execute();
        if($result){
            return $ps->rowCount();
        }
        else{
            return false;
        }
    }
    
     function readAllPosts(){
        $sql = "SELECT * FROM {$this->table}";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
    
    public function setPostAsPublished(){
        $data = array("post_status"=>"published");
        updatePost($data, "post_id = {$post_id}");
    }
    
    public function setPostAsDraft(){
        $data = array("post_status"=>"draft");
        updatePost($data, "post_id = {$post_id}");
    }
    
    function readAllPostsOfCategory($category_id){
        $sql = "SELECT * FROM {$this->table} WHERE post_category_id = {$category_id}";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
    
     
    function readAllPostsOfAuthor($user_id,$start = 0,$end = 0){
        
        if($start>0 && $end>0){
        $sql = "SELECT * FROM posts WHERE post_author_id = {$user_id} LIMIT $start,$end";
        
        }
        else{
            $sql = "SELECT * FROM posts WHERE post_author_id = {$user_id}";
        }
        
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function readAllPostsBySearch($keyword){
        $sql = "SELECT posts.post_id, posts.post_category_id, posts.post_title, posts.post_body, posts.post_tags, posts.post_author_id, posts.post_date, posts     .post_image, posts         .post_status, posts.created_at, posts.updated_at, CONCAT(members.member_first_name,CONCAT(\" \",members.member_last_name)) AS post_author FROM posts,members WHERE (members.member_id=posts.post_author_id) AND (members.member_first_name LIKE '%{$keyword}%' OR members.member_last_name LIKE '%{$keyword}%' OR posts.post_tags LIKE '%{$keyword}%' OR posts.post_title LIKE '%{$keyword}%' OR posts.post_body LIKE '%{$keyword}%'  OR CONCAT(members.member_first_name,CONCAT(\" \",members.member_last_name)) LIKE '%{$keyword}%')";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
    
//    function readAllPostsOfAuthor($post_author_id){
//        $sql = "SELECT * FROM {$this->table} WHERE post_author_id = {$post_author_id}";
//        $statement = $this->conn->prepare($sql);
//        $statement->execute();
//        $result = $statement->fetchAll();
//        return $result;
//    }
    
    
    
    function readPost($post_id){
        $sql = "SELECT * FROM {$this->table} WHERE post_id = {$post_id}";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $keys = array_keys($result);
        for($i = 0; $i<count($keys); $i++){
            $this->{$keys[$i]} = $result[$keys[$i]];
        }
        $this->post_author = $this->getAuthorName($this->post_author_id);
    }
    
    function getAuthorName($post_author_id){
        $sql = "SELECT member_first_name, member_last_name FROM members WHERE member_id = {$post_author_id}";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetch();
        return $result['member_first_name']." ".$result['member_last_name'];
    }
    
    
    
    

    /**
     * @return mixed
     */
    public function getPostAuthor()
    {
        return $this->post_author;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * @return mixed
     */
    public function getPostCategoryId()
    {
        return $this->post_category_id;
    }

    /**
     * @return mixed
     */
    public function getPostTitle()
    {
        return $this->post_title;
    }

    /**
     * @return mixed
     */
    public function getPostBody()
    {
        return $this->post_body;
    }

    /**
     * @return mixed
     */
    public function getPostTags()
    {
        return $this->post_tags;
    }

    /**
     * @return mixed
     */
    public function getPostAuthorId()
    {
        return $this->post_author_id;
    }

    /**
     * @return mixed
     */
    public function getPostStatus()
    {
        return $this->post_status;
    }

    /**
     * @return mixed
     */
    public function getPostDate()
    {
        return $this->post_date;
    }

    /**
     * @return mixed
     */
    public function getPostImage()
    {
        return $this->post_image;
    }
}
?>