<?php
	class CommentController extends BaseController
	{
		public function getRessourceComments($ressourceId){
			$comments = $this->CommentManager->getRessourceComments($ressourceId);
			echo json_encode($comments);
		}

		public function createComment($ressourceId,$creator,$content)
		{
			$comment = new Comment();
			$comment->idUser = $creator;
			$comment->ressource = $ressourceId;
			$comment->contenu = $content;
			$result = $this->CommentManager->create($comment,array("idUser","ressource","contenu"));
			if($result){
				echo json_encode(array("status"=>"success","code"=>"0001","message"=>"Comment created"));

			}else{
				echo json_encode(array("status"=>"error","code"=>"0099","message"=>"Error while inserting into database"));
			}
		}
    }