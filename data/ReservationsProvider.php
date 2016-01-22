<?php

namespace app\data;

use \app\models\Book;

class ReservationsProvider extends \yii\data\ArrayDataProvider
{
	/**
     * Initialize the dataprovider by filling allModels
     */
    public function init()
    {
        //Get all all authors with their articles
	    $query = Book::find()->with('tour');
		foreach($query->all() as $book) {
                    //print '<pre>'; print_r($book->tour); die();
			//Get the last published date if there are articles for the author
			/*if (count($author->articles)) {
				$lastPublished = $query->max('Published');
			} else {
				$lastPublished = null;
			}*/

			//Add rows with the Author, # of articles and last publishing date
			$this->allModels[] = [
				'date' => $book->date,
				'title' => $book->tour->title,
				'id' => $book->id,
			];
		}
	}
}

