<?php

/**
 * Description of template
 *
 * @author Gerd
 */
class template {
    function hearderSettings(){
        $head = '';
        $head .= '<!DOCTYPE html >';
        $head .= "<title>Demo site</title>";
        $head .= '<META NAME="Author" CONTENT="Gerd Ratsch">';
        $head .= '<META NAME="description" CONTENT="Demo assignment">';
        $head .= "<link rel='stylesheet' href='/css/demo.css' />";
        return $head;
    }
    function pageTemplate($pageTitle, $nav, $section, $body, $pageFooter){
        require_once './class/menu.php';
        $pagecontent = '';
        $pagecontent .= template::hearderSettings();
        $pagecontent .= '<header><h1>'.$pageTitle.'</h1></header>';
        $pagecontent .= '<nav>'. menu::menu_blok().$nav.'</nav>';
        $pagecontent .= '<section>'.$section.'</section>';
        $pagecontent .= '<aside>'.$body.'</aside>';
        $pagecontent .= '<footer>'.$pageFooter.'<footer>';
        return $pagecontent;
    }
    function buildForm($result, $action, $legend){
      $formContent = '<form action="'.$action.'" method="post">';
      $formContent .= '<fieldset><legend>'.$legend.'</legend>';
      foreach ($result as $field_Name => $field_Value) {
          $fieldtype = substr($field_Name, 0, 3);
          $fieldname = substr($field_Name, 3);
          if($fieldtype == 'm_i'){
              $type='number';
          }
          if($fieldtype == 'm_s'){
              $type='text';
          }
          if($fieldname =='Message'){
                $formContent .= '<p class="'.$fieldname.'"><span class="fieldname">'.$fieldname.'</span><textarea  name="'.$fieldname.'" >'.$field_Value.'</textarea></p>';
          }else{
                $formContent .= '<p class="'.$fieldname.'"><span class="fieldname">'.$fieldname.'</span><input type="'.$type.'" name="'.$fieldname.'" value="'.$field_Value.'"></p>';
          }
      }

      $formContent .= '<input type="submit" value="Submit"></fieldset></form>';
      return $formContent;
    }
    function buildTable($result, $tableTitle){
        
        $tableContent = '<h1 class="tabledisplay">'.$tableTitle.'</h1><table>';
        $tableHeader='';
        $tablebody='';
        $rownum = 1;
        foreach ($result as $key => $row) {
            if($tableHeader==''){
                $tableHeader .= '<tr class="tableHeader">';
                $rowheader = 1;
            }
            if($rownum == 1){
                $tablebody .='<tr class="tablerow oneven">';
                $rownum = 2;
            }else{
                $tablebody .='<tr class="tablerow even">';
                $rownum = 1;
            }
            foreach ($row as $headername => $fieldValue) {
                if($rowheader == 1){
                    $tableHeader .= '<th class="'.$headername.'">'.$headername.'</th>';
                }
                $tablebody .= '<td class="'.$headername.'">'.$fieldValue.'</td>';
            }
            if($rowheader == 1){
                $tableHeader .= '</tr>';
                $rowheader = 2;
            }
            $tablebody .='</tr>';
        }
        
        $tableContent .= $tableHeader.$tablebody.'</table>';
        return $tableContent;
    }
}
