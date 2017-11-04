<?php

/**
 * Description of Post
 *
 * @author Gerd
 */
class Post {
    var $m_iID;
    var $m_sTitle;
    var $m_sMessage;
    var $m_iIDauthor;
    
    public function __construct() {
        $this->m_iID = 0;
        $this->m_sTitle ="";
        $this->m_sMessage ="";
        $this->m_iIDauthor ="";
    }
    public function displayPostList($aResult){
        $newaResult='';
        foreach ($aResult as $rowid => $rowvalue) {

            foreach ($rowvalue as $fieldname => $fieldValue) {
                if ($fieldname == 'AuthorID'){
                    $AuthorID = $fieldValue;
                }
                if ($fieldname == 'Name'){
                    $Name = $fieldValue;
                    
                }
                if ($fieldname == 'PostID'){
                    $iPostID = $fieldValue;
                }
                if ($fieldname == 'Title'){
                    $newaResult[$rowid]['Post titel']='<a href="/post/'.$iPostID.'">'.$fieldValue.'</a>';
                    $newaResult[$rowid]['Author naam']='<a href="/author/'.$AuthorID.'">'.$Name.'</a>';
                }

            }
        }
        return $newaResult;
    }
}
