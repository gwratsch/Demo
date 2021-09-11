<?php
//test 4
require_once __DIR__.'/vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
$app = new Silex\Application();

$app['debug'] = false;

require_once '/class/sqllist.php';
$sqllist = new sqllist();

function inputCheck($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = str_replace('"',"'",$data);
    return $data;
}

$app->get('/', function () use ( $sqllist) {
    require_once '/class/Author.php';
    require_once '/class/template.php';
    
    $authorList = $sqllist->selectAuthors();
    $aResult = $authorList->fetchall();   
    
    // change author display info.
    $aResult = Author::displayAuthorInfo($aResult);
    
    // variables for page build.
    $tableTitle = '';
    $body = template::buildTable($aResult, $tableTitle);
    
    $nav = '<a href="/author/new" >Author aanmaken</a>';
    $section = '';   
    $pageTitle = 'Author overzicht';
    $pageFooter = '';
    $output = template::pageTemplate($pageTitle,$nav,$section, $body, $pageFooter);

    return $output;
});


$app->get('/author',function ()  use ( $sqllist) {

    require_once '/class/Author.php';
    require_once '/class/template.php';
    
    $authorList = $sqllist->selectAuthorPostsAll();
    $aResult = $authorList->fetchall();  
    
    $aResult = Author::displayAuthorPostList($aResult);
    $tableTitle = '';
    $body = template::buildTable($aResult, $tableTitle);
    
    $nav = '';
    $section = '';    
    $pageTitle = 'Author overzicht';
    $pageFooter = '';
    $output = template::pageTemplate($pageTitle, $nav, $section,  $body, $pageFooter);

    return $output;
} ); 

$app->get('/author/new', function (Silex\Application $app) {
    require_once '/class/author.php';
    require_once '/class/template.php';
    
    $sAuthor = new Author();
    $action='/author/addNew';
    $legend = 'New Author';
    $body = template::buildForm($sAuthor, $action, $legend);
    
    $nav = '';
    $section = '';    
    $pageTitle = 'Pagina Author';
    $pageFooter = '';
    $output = template::pageTemplate($pageTitle, $nav, $section, $body, $pageFooter);

    return $output;
} ); 

$app->post('/author/addNew', function (Request $request) use ($app){

    $Name = inputCheck($request->get('Name'));
            
    $tableTitle = 'Author aanmaken';
    $ID = sqllist::insertAuthor($Name);
    return $app->redirect('/author/'.$ID);
} );

$app->get('/author/{id}', function (Silex\Application $app, $id)  use ( $sqllist) {
    require_once '/class/Author.php';
    require_once '/class/template.php';
    
    $cAuthorList = $sqllist->selectAuthorPosts($id);
    $aResult = $cAuthorList->fetchall();
    

    // change author display info.
    $aResult = Author::displayAuthorPost($aResult);
    $tableTitle = 'Post onderwerpen';   
    if(is_array($aResult)){
        $body = template::buildTable($aResult, $tableTitle);
    }else{
        $body = '';
    }
    
    $nav = '<span class="newPostLink"><a href="/post/new'.$id.'" >Post aanmaken</a></span>';
    $section = '<p class="DelAuthorLink boxDisplay"><a href="/author/'.$id.'/delete" >Delete author</a></p><p class="UpdAuthorLink boxDisplay"><a href="/author/'.$id.'/update" >Update author</a></p>';
    $pageTitle = 'Author '. Author::authorName($id);
    $pageFooter = '';
    $output = template::pageTemplate($pageTitle,$nav,$section, $body, $pageFooter);

    return $output;
} ); 

//Build update form for Author content
$app->get('/author/{id}/update', function (Silex\Application $app, $id) use ($app, $sqllist){
    require_once '/class/Author.php';
    require_once '/class/template.php';
    
    $getDBsql = $sqllist->selectAuthor($id);
    $getDBresult = $getDBsql->fetchall();
    $sAuthor = new Author();
    $sAuthor->m_iID = $id;    
    foreach ($getDBresult as $key => $value) {
        foreach ($value as $keyn => $valuef) {
            if($keyn =='Name'){$sAuthor->m_sName = $valuef;}
        }
    }
    
    $action='/author/u'.$id;
    $legend = 'Change Author';
    $body = template::buildForm($sAuthor, $action, $legend);
    
    $nav = '';
    $section ='';    
    $pageTitle = 'Pagina author';
    $pageFooter = '';
    $output = template::pageTemplate($pageTitle, $nav, $section ,$body, $pageFooter);

    return $output;
} );

//Update the name of the author with ID..
$app->post('/author/u{id}', function (Request $request) use ($app){
    $ID = $request->get('ID');
    $Name = inputCheck($request->get('Name'));
            
    sqllist::updateAuthor($ID, $Name);
    return $app->redirect('/author/'.$ID);
} );

//Delete the author and his posts
$app->get('/author/{id}/delete', function (Silex\Application $app, $id) use ($app, $sqllist){
    require_once '/class/template.php';
    $ID=0;
    $getDBsql = $sqllist->selectAuthor($id);
    $getDBresult = $getDBsql->fetchall();   
    foreach ($getDBresult as $key => $value) {
        foreach ($value as $keyn => $valuef) {
            if($keyn =='ID'){$ID = $valuef;}
            if($keyn =='Name'){$IDauthor = $valuef;}
        }
    }
    
    if($ID>0){
        sqllist::deleteAuthor($ID);
        return $app->redirect('/');
    }else{
        $nav = '';
        $section ='';
        $body = '<p>Verzoek om een account te verwijderen is niet uitgevoerd.</p><p>De opgegeven author is niet gevonden.</p>';
        $pageTitle = 'Pagina author';
        $pageFooter = '';
        $output = template::pageTemplate($pageTitle, $nav, $section ,$body, $pageFooter);
        return $output;
    }
    
} );

$app->get('/post',function ()  use (  $sqllist) {

    require_once '/class/Post.php';
    require_once '/class/template.php';
    
    $authorPostList = $sqllist->selectPostsAuthor();
    $Result = $authorPostList->fetchall();  
    
    $aResult = Post::displayPostList($Result);
    $tableTitle = '';
    $body = template::buildTable($aResult, $tableTitle);
    
    $nav = '';
    $section = '';    
    $pageTitle = 'Post overzicht';
    $pageFooter = '';
    $output = template::pageTemplate($pageTitle, $nav, $section,  $body, $pageFooter);

    return $output;
} ); 

$app->get('/post/new{id}', function (Silex\Application $app, $id) {
    require_once '/class/Post.php';
    require_once '/class/template.php';
    
    $sPost = new Post();
    $sPost->m_iIDauthor = $id;
    $action='/post/new';
    $legend = 'New Post';
    $body = template::buildForm($sPost, $action, $legend);
    
    $nav = '';
    $section = '';    
    $pageTitle = 'Pagina Post';
    $pageFooter = '';
    $output = template::pageTemplate($pageTitle, $nav, $section, $body, $pageFooter);

    return $output;
} ); 

$app->post('/post/new', function (Request $request) use ($app){

    $Title = inputCheck($request->get('Title'));
    $Message = inputCheck($request->get('Message'));
    $IDauthor = $request->get('IDauthor');
            
    sqllist::insertPost($Title, $Message, $IDauthor);
    return $app->redirect('/author/'.$IDauthor);
} );


$app->get('/post/{id}', function (Silex\Application $app, $id) use ($sqllist){
    require_once '/class/Post.php';
    require_once '/class/template.php';
    
    $getDBsql = $sqllist->selectPost($id);
    $getDBresult = $getDBsql->fetchall();
    
    $sPost = new Post();
    $sPost->m_iID = $id;    
    foreach ($getDBresult as $key => $value) {
        foreach ($value as $keyn => $valuef) {
            if($keyn =='Title'){$sPost->m_sTitle = $valuef;}
            if($keyn =='Message'){$sPost->m_sMessage = $valuef;}
            if($keyn =='IDauthor'){$sPost->m_iIDauthor = $valuef;}
        }

    }
    
    $action='/post/u'.$id;
    $legend = 'Change Post';
    $body = template::buildForm($sPost, $action, $legend);
    
    $nav = '';
    $section = '';    
    $pageTitle = 'Pagina Post';
    $pageFooter = '';
    $output = template::pageTemplate($pageTitle, $nav, $section, $body, $pageFooter);

    return $output;
} ); 

$app->post('/post/u{id}', function (Request $request) use ($app){
    $ID = $request->get('ID');
    $Title = inputCheck($request->get('Title'));
    $Message = inputCheck($request->get('Message'));
    $IDauthor = $request->get('IDauthor');
            
    $ID = sqllist::updatePost($ID,$Title, $Message);
    return $app->redirect('/author/'.$IDauthor);
} );

$app->get('/post/{id}/delete', function (Silex\Application $app, $id) use ($app, $sqllist){

    $getDBsql = $sqllist->selectPost($id);
    $getDBresult = $getDBsql->fetchall();  
    
    foreach ($getDBresult as $key => $value) {
        foreach ($value as $keyn => $valuef) {
            if($keyn =='ID'){$ID = $valuef;}
            if($keyn =='IDauthor'){$IDauthor = $valuef;}
        }

    }
    
    $ID = sqllist::deletePost($ID);
    return $app->redirect('/author/'.$IDauthor);
} );

$app->error(function (\Exception $e, Request $request, $code){
    require_once '/class/template.php';
    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            break;
        default:
            $message = 'We are sorry, but something went terribly wrong.';
    }
    $nav = '';
    $section = '';    
    $pageTitle = 'Error';
    $pageFooter = '';
    $body = $message;
    $output = template::pageTemplate($pageTitle, $nav, $section, $body, $pageFooter);

    return new Response($output);
});

$app->run();