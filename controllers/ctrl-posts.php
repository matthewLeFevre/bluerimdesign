<?php 

/* Eventually we will get an include file */

require_once $_SERVER['DOCUMENT_ROOT'].'/library/includes.php';

$action = filter_input(INPUT_POST, 'action');

if ($action == NULL){

    $action = filter_input(INPUT_GET, 'action');

    if($action == NULL){

        $action = 'post_create';

    }

}

switch ($action) {

    case 'post_create_view':
        $topics = $topicService->getAll();
        include $_SERVER['DOCUMENT_ROOT'] . '/views/admin/blog-create.php';
        break;

    case 'post_create_process':

        // post creation form inputs

        $topicId    = filter_input(INPUT_POST, 'topicId',   FILTER_SANITIZE_NUMBER_INT);
        $titleWeb   = filter_input(INPUT_POST, "titleWeb",  FILTER_SANITIZE_STRING);
        $titleBlog  = filter_input(INPUT_POST, "titleBlog", FILTER_SANITIZE_STRING);
        $summary    = filter_input(INPUT_POST, "summary",   FILTER_SANITIZE_STRING);
        $videoEmbed = filter_input(INPUT_POST, "videoEmbed",FILTER_SANITIZE_STRING);
        $videoUrl   = filter_input(INPUT_POST, "videoUrl",  FILTER_SANITIZE_STRING);
        $status     = filter_input(INPUT_POST, 'status',    FILTER_SANITIZE_STRING);
        $iconPath   = filter_input(INPUT_POST, 'iconPath',  FILTER_SANITIZE_STRING);
        $markup     = filter_input(INPUT_POST, "markup");
        $userId     = $_SESSION['userData']['id'];
        $infoArr    = array("titleWeb"  => $titleWeb, 
                            "titleBlog" => $titleBlog, 
                            "summary"   => $summary, 
                            "markup"    => $markup, 
                            "videoEmbed"=> $videoEmbed, 
                            "videoUrl"  => $videoUrl,
                            "userId"    => $userId,
                            "topicId"   => $topicId,
                            "status"    => $status,
                            "iconPath"  => $iconPath);

        // post creation logic

        $newPost = new Post("create", $infoArr);
        // $cleared = $newPost->checkCreate();
        $result  = $newPost->create();
  
        if($result) {

        // on success redirect to the detail view of the post
            $blog = $postService->getVariable(1);
            header("location: /controllers/ctrl-posts.php?action=post_detail&id=" . $blog[0]['id']);
            
        } else {

        // on error send error message

            echo "<h1>error</h1>";
        }
        break;


    case 'post_edit_view':
        $topics = $topicService->getAll();
        $blog = $postService->getById(filter_input(INPUT_GET, 
                                                    "id", 
                                                    FILTER_SANITIZE_NUMBER_INT));
        include $_SERVER['DOCUMENT_ROOT'] . '/views/admin/blog-edit.php';
        break;


    case 'post_edit_process':
        $getPost = $postService->getById(2);
        

        $editPost = new Post( "edit", array(
                                        "id"        =>$getPost['id'], 
                                        "titleWeb"  =>$getPost["titleWeb"],
                                        "titleBlog" =>$getPost["titleBlog"],
                                        "summary"   =>$getPost["summary"],  
                                        "markup"    =>$getPost["markup"],   
                                        "videoEmbed"=>$getPost["videoEmbed"],
                                        "videoUrl"  =>$getPost["videoUrl"]));
        $result = $editPost->edit();

        if($result) {
            //send success response
        } else {
            //send error response
        }
        break;

    case 'post_delete_view':
        include $_SERVER['DOCUMENT_ROOT'] . '/views/participate.php';
        break;

    case 'post_delete_process':
        $result = $postService->deleteById(filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT));
        break;

    case "get_post_by_id":
        $blog = $postService->getById(filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT));
        include $_SERVER['DOCUMENT_ROOT'] .'/views/blogs/blog-view.php';
        break;

    case "post_detail":
        $blog = $postService->getById(filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT));
        include $_SERVER['DOCUMENT_ROOT'] .'/views/admin/blog-detail.php';
        break;
}