<?php
//TODO sur BDD ressource : ImgPath & cotenu = Path
	class RessourceController extends BaseController
	{
		public function getRessource($id){
			$ressource = $this->RessourceManager->getById($id);
			$ressource->contenu = file_get_contents($ressource->imgPath."content.txt");
			$ressource->imgPath = file_get_contents($ressource->imgPath."header.txt");
			echo json_encode($ressource);
		}

		public function searchRessource($search){
			$ressources = $this->RessourceManager->searchRessource($search);
			$rfinal = array();
			foreach($ressources as $ressource){
				$ressource->imgPath = file_get_contents($ressource->imgPath."header.txt");
				$rfinal[] = $ressource;
			}
			
			echo json_encode($rfinal);
		}

		public function getRessourcesHeaders(){
			$ressources = $this->RessourceManager->getRessourcesHeaders();
			$rfinal = array();
			foreach($ressources as $ressource){
				$ressource->imgPath = file_get_contents($ressource->imgPath."header.txt");
				$rfinal[] = $ressource;
			}
			
			echo json_encode($rfinal);
		}

		public function createRessource($title,$type,$content,$imagePath,$creator)
		{

			$path = "./data/ressources/";
			$random = $this->generateRandomString();
			$finalpath = $path . $random."/";
			mkdir($finalpath,0775);
			$filename = $finalpath."content.txt";
			file_put_contents($filename,$content);
			$imgFilename = $finalpath."header.txt";
			file_put_contents($imgFilename,$imagePath);
			

			$ressource = new Ressource();
			$ressource->titre = $title;
			$ressource->type = $type;
			$ressource->contenu = $filename;
			$ressource->imgPath = $finalpath;
			$ressource->createur = $creator;
			$result = $this->RessourceManager->create($ressource,array("titre","type","contenu","imgPath","createur"));
			
			if($result){
				echo json_encode(array("status"=>"success","code"=>"0001","message"=>"Ressource created"));

			}else{
				echo json_encode(array("status"=>"error","code"=>"0099","message"=>"Error while inserting into database"));
			}
		}

		private function generateRandomString($length = 10) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[random_int(0, $charactersLength - 1)];
			}
			return $randomString;
		}
	}