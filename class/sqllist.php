<?php

/**
 * Description of sqllist
 *
 * @author Gerd
 */
class sqllist{
    
    //database connection settings in /vendor/config/dbconfig.php
    protected function connect(){
        require_once '/vendor/config/dbconfig.php';
        $conndb = new connect();
        $conn = $conndb->connectDB();
        return $conn;
    }
    
    function selectAuthors(){
        $conn = sqllist::connect();

        $sql = "SELECT * FROM author order by Name ASC";
        $sqlfunc = $conn->query($sql);
        return $sqlfunc;
    }
    function selectAuthor($id){
        $conn = sqllist::connect();

        $sql = "SELECT * FROM author where ID = ".$id;
        $sqlfunc = $conn->query($sql);
        return $sqlfunc;
    }
    function selectAuthorID($name){
        $conn = sqllist::connect();

        $sql = 'SELECT ID FROM author where name = "'.$name.'"';
        $sqlfunc = $conn->query($sql);
        return $sqlfunc;
    }
    function selectAuthorPosts($idAuthor){
        $conn = sqllist::connect();

        $sql = "SELECT a.ID as AuthorID, a.name as Name, p.ID as PostID,p.Title as Title, p.message as Message FROM author a, post p where a.ID = p.IDauthor and a.ID = ".$idAuthor;
        $sqlfunc = $conn->query($sql);
        return $sqlfunc;
    }
    function selectAuthorPostsAll(){
        $conn = sqllist::connect();

        $sql = "SELECT a.ID as AuthorID, a.name as Name, p.ID as PostID,p.Title as Title, p.message as Message FROM author a, post p where a.ID = p.IDauthor order by a.name ASC ";
        $sqlfunc = $conn->query($sql);
        return $sqlfunc;
    }
    function selectPostsAuthor(){
        $conn = sqllist::connect();

        $sql = "SELECT a.ID as AuthorID, a.name as Name, p.ID as PostID,p.Title as Title, p.message as Message FROM author a, post p where a.ID = p.IDauthor order by p.ID DESC ";
        $sqlfunc = $conn->query($sql);
        return $sqlfunc;
    }
    function deleteAuthor($idAuthor){
        $conn = sqllist::connect();

        $sql = "delete FROM author where ID = ".$idAuthor;
        $sqlfunc = $conn->query($sql);
        $sql = "delete FROM post where IDauthor = ".$idAuthor;
        $sqlfunc = $conn->query($sql);
    }
    function updateAuthor($idAuthor, $name){
        $conn = sqllist::connect();

        $sql = 'update author set name = "'.$name.'" where ID = '.$idAuthor;
        $sqlfunc = $conn->query($sql);
        //return $sqlfunc;
    }
    function insertAuthor($name){
        $conn = sqllist::connect();

        $sql = 'insert into author (name) Values ( "'.$name.'")';
        $sqlfunc = $conn->query($sql);
        //stuur het nieuwe id terug.
        $sqlSdelectID = sqllist::selectAuthorID($name);
        $aSqlSdelect = $sqlSdelectID->fetchAll();
        foreach ($aSqlSdelect as $value) {
            $ID = $value['ID'];
        }
        return $ID; 
    }
    
    function selectPost($id){
        $conn = sqllist::connect();

        $sql = "SELECT * FROM post where ID = ".$id;
        $sqlfunc = $conn->query($sql);
        return $sqlfunc;
    }
    function deletePost($id){
        $conn = sqllist::connect();

        $sql = "DELETE FROM post where ID = ".$id;
        $sqlfunc = $conn->query($sql);
    }
    function updatePost($id,$title, $message){
        $conn = sqllist::connect();

        $sql = 'update post set title = "'.$title.'", Message = "'.$message.'" where ID = '.$id;
        $sqlfunc = $conn->query($sql);
        //return $sqlfunc;
    }
    function insertPost($title, $message, $IDauthor){
        $conn = sqllist::connect();

        $sql ='insert into post (Title, Message, IDauthor) Values ( "'.$title.'", "'.$message.'", '.$IDauthor.')';
        $sqlfunc = $conn->query($sql);
        //return $sqlfunc;
    }
}
