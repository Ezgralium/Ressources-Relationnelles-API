<?php
	class LikesController extends BaseController
	{
        public function setLike($ressourceId, $userId, $liked){
			echo json_encode($this->LikesManager->setLike($ressourceId, $userId, $liked));
		}
    }