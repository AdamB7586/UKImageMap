<?php
namespace UKMap;

use DBAL\Database;
use Configuration\Config;

class Map{
    protected $db;
    protected $config;
    
    /**
     * Constructor add an instance of the database object
     * @param Database $db This should be an instance of the database object
     */
    public function __construct(Database $db, Config $config) {
        $this->db = $db;
        $this->config = $config;
    }
    
    /**
     * Get all of the regions for the national UK map
     * @return array|false If regions exist they will be returned as an array else will return false
     */
    public function getRegions() {
        return $this->db->selectAll($this->config->table_uk);
    }
    
    /**
     * List all of the postcode within a selected region of the UK
     * @param string $region This should be the URL safe name of the region
     * @return array|false If postcode areas exist for the region they will be returned as an array else will return false
     */
    public function getRegionPostcodes($region) {
        return $this->db->selectAll($this->config->table_regions, array('area' => $region), '*', array('postcode' => 'ASC'));
    }
    
    /**
     * Returns the information in the database for a given region
     * @paramstring $region This should be the URL safe name of the region
     * @return array|false If the region exists the information will be returned as an array else will return false
     */
    public function getRegionInfo($region) {
        return $this->db->select($this->config->table_uk, array('url' => $region));
    }
    
    /**
     * Gets the information for a postcode by the URL
     * @param string $url This should be the URL for the selected postcode
     * @return array|false If the postcode information exists will return an array else will return false
     */
    public function getPostcodeAreaInfoByURL($url){
        return $this->getPostcodeAreasInfo(array('url' => $url));
    }
    
    /**
     * Gets the information for a postcode by the Postcode for this area e.g. WF, LS, AB, LN, etc
     * @param string $postcode This should be the postcode 
     * @return array|false If the postcode information exists will return an array else will return false
     */
    public function getPostcodeAreaInfoByPostcode($postcode){
        return $this->getPostcodeAreasInfo(array('postcode' => strtoupper($postcode)));
    }
    
    /**
     * Returns postcode area information based on the the given where parameters 
     * @param array $where This should be an array containing the fields and values you wish to search using
     * @return array|false If the postcode information exists will return an array else will return false
     */
    protected function getPostcodeAreasInfo($where){
        if(is_array($where)){
            return $this->db->select($this->config->table_regions, $where);
        }
        return false;
    }
    
    /**
     * List of all the postcode areas and details
     * @return array|false Will return a list of all of the postcode areas in the database if any exists else will return false
     */
    public function listPostcodeAreas(){
        return $this->db->selectAll($this->config->table_regions);
    }
    
    /**
     * Counts the number of postcode areas which exist in the database
     * @return int Will return the number of postcode areas in the database
     */
    public function countPostcodeAreas(){
        return $this->db->count($this->config->table_regions);
    }
    
}