<?php

/**
 * Description of Author
 *
 * @author Gerd
 */
class Author {
    var $m_iID;
    var $m_sName;
    
    public function __construct() {
        $this->m_iID = 0;
        $this->m_sName ="";
    }
    public function authorName($id){
        require_once '/class/sqllist.php';
        $conn = new sqllist();
        $authorIdselect = $conn->selectAuthor($id);
        $aAuthorName = $authorIdselect->fetchall();
        foreach ($aAuthorName as $value) {
            foreach ($value as $name) {
                $sAuthorName = $name;
            }
        }
        return $sAuthorName;
    }
    public function displayAuthorInfo($aResult){
        $newaResult='';
        $iID = 0;
        foreach ($aResult as $rowid => $rowvalue) {

            foreach ($rowvalue as $fieldname => $fieldValue) {
                if ($fieldname == 'ID'){
                    $iID = $fieldValue;
                }
                if ($fieldname == 'Name'){
                    $newfieldValue = '<a href="/author/'.$iID.'">'.$fieldValue.'</a>';
                    $newaResult[$rowid]['Author naam']=$newfieldValue;
                }else{
                    $newaResult[$rowid][$fieldname]=$fieldValue;
                }
            }
        }
        return $newaResult;
    }
    public function displayAuthorPost($aResult){
        $newaResult='';
        foreach ($aResult as $rowid => $rowvalue) {

            foreach ($rowvalue as $fieldname => $fieldValue) {
                if ($fieldname == 'AuthorID'){
                    $iAuthorID = $fieldValue;
                }
                if ($fieldname == 'PostID'){
                    $iPostID = $fieldValue;
                    $DeletePostUrl = '<a href="/post/'.$iPostID.'/delete"> Delete</a>';
                    $UpdatePostUrl = '<a href="/post/'.$iPostID.'"> Update</a>';
                }
                if ($fieldname == 'Title'){
                    $newaResult[$rowid][$fieldname]=$fieldValue;
                }
                if ($fieldname == 'Message'){
                    $newaResult[$rowid][$fieldname]=$fieldValue;
                    $newaResult[$rowid]['Update']=$UpdatePostUrl;
                    $newaResult[$rowid]['Delete']=$DeletePostUrl;
                }
            }
        }
        return $newaResult;
    }
    public function displayAuthorPostList($aResult){
        $newaResult='';
        foreach ($aResult as $rowid => $rowvalue) {

            foreach ($rowvalue as $fieldname => $fieldValue) {
                if ($fieldname == 'AuthorID'){
                    $AuthorID = $fieldValue;
                }
                if ($fieldname == 'Name'){
                    $Name = $fieldValue;
                    $newaResult[$rowid]['Author naam']='<a href="/author/'.$AuthorID.'">'.$Name.'</a>';
                }
                if ($fieldname == 'PostID'){
                    $iPostID = $fieldValue;
                }
                if ($fieldname == 'Title'){
                    $newaResult[$rowid]['Post titel']='<a href="/post/'.$iPostID.'">'.$fieldValue.'</a>';
                    
                }

            }
        }
        return $newaResult;
    }
}
