<?php
/**
 * Created by PhpStorm.
 * User: exodus4d
 * Date: 17.05.15
 * Time: 20:43
 */

namespace Model;

class CorporationModel extends BasicModel {

    protected $table = 'corporation';

    protected $fieldConf = array(
        'corporationCharacters' => array(
            'has-many' => array('Model\CharacterModel', 'corporationId')
        ),
        'mapCorporations' => array(
            'has-many' => array('Model\CorporationMapModel', 'corporationId')
        )
    );

    /**
     * get all cooperation data
     * @return array
     */
    public function getData(){
        $cooperationData = (object) [];

        $cooperationData->id = $this->id;
        $cooperationData->name = $this->name;
        $cooperationData->sharing = $this->sharing;


        return $cooperationData;
    }

    /**
     * get all maps for this corporation
     * @return array|mixed
     */
    public function getMaps(){
        $maps = [];

        if($this->mapCorporations){
            foreach($this->mapCorporations as $mapCorporation){
                if($mapCorporation->mapId->isActive()){
                    $maps[] = $mapCorporation->mapId;
                }
            }
        }

        return $maps;
    }

    /**
     * get all characters in this corporation
     * @return array
     */
    public function getCharacters(){
        $characters = [];

        $this->filter('corporationCharacters', array('active = ?', 1));

        if($this->corporationCharacters){
            foreach($this->corporationCharacters as $character){
                $characters[] = $character;
            }
        }

        return $characters;
    }
} 