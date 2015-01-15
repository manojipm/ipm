<?php

/**
 * Component for working common.

 */
class CommonComponent extends Component {

    public $components = array('Session', 'Email','Paginator');

    public function countriesMenu() {

        $this->Country = ClassRegistry::init('Country');

        $datas = $this->Country->find('list', array(
            'fields' => array('Country.iso_code', 'Country.name'),
            'limit' => 35,
        ));

        return $datas;
    }

    public function countriesList() {

        $this->Country = ClassRegistry::init('Country');

        $datas = $this->Country->find('list', array(
            'fields' => array('Country.iso_code', 'Country.name'),
            'order' => array('Country.name ASC')
        ));

        return $datas;
    }

    public function citiesListIsoCodeBased($isoCode = null) {

        $this->City = ClassRegistry::init('City');
        ini_set('max_execution_time', 360000);



        $datas = $this->City->find('list', array(
            'fields' => array('City.id', 'City.name'),
            'conditions' => array('City.country_iso_code' => $isoCode),
            'order' => array('City.name ASC'),
        ));

        return $datas;
    }

    public function settings($key = null) {

        $this->Settings = ClassRegistry::init('Settings');

        $datas = $this->Settings->findByKey($key);

        return $datas;
    }

    public function getCityByStateCountryCode($StateCode = null, $isoCode = null) {

        $this->City = ClassRegistry::init('City');
        $datas = $this->City->find('list', array(
            'fields' => array('id', 'city_name_ascii'),
            'conditions' => array('City.country_iso_code' => $isoCode, 'City.state_code' => $StateCode),
            'order' => array('City.name ASC'),
        ));

        return $datas;
    }

    public function getStatesByIsoCode($isoCode = null) {

        $this->State = ClassRegistry::init('State');
        $datas = $this->State->find('list', array(
            'fields' => array('code', 'name'),
            'conditions' => array('State.country_iso_code' => $isoCode),
            'order' => array('State.name ASC'),
        ));

        return $datas;
    }
    public function getState($id = null) {
         $state = ClassRegistry::init('State')->find('first',array('conditions'=>array('id'=>$id)) );
         return isset($state['State']['name']) ? $state['State']['name'] : '-';
    }



    // Get Sliders for front end
    public function getSlider($role_id = OTHER_ID) {
        $sliders = '';
        if (!empty($role_id)) {
            $this->Slider = ClassRegistry::init('Slider');
            $sliders = $this->Slider->find('all', array(
                'fields' => array('id', 'slider_image'),
                'conditions' => array('Slider.role_id' => $role_id, 'Slider.status' => 1),
                'order' => array('Slider.id ASC'),
            ));
        }
        return $sliders;
    }

    // Get news for home page
    public function getNews($role_id = OTHER_ID, $limit = '') {
        $news = '';
        if (!empty($role_id)) {
            $this->News = ClassRegistry::init('News');
            $news = $this->News->find('all', array(
                'fields' => array('id', 'title', 'description', 'news_image'),
                'conditions' => array('role_id' => $role_id, 'News.status' => 1, 'News.published <= ' => time()),
                'limit' => $limit,
                'order' => array('News.published DESC'),
            ));
        }
        return $news;
    }

    // Get testimonials for home page
    public function getTestimonials($role_id = OTHER_ID, $limit = '') {
        $testimonials = '';
        if (!empty($role_id)) {
            $this->Testimonial = ClassRegistry::init('Testimonial');
            $this->Testimonial->recursive = 2;
            //$this->User = ClassRegistry::init('User');

            $testimonials = $this->Testimonial->find('all', array(
                'fields' => array('id', 'user_id', 'title', 'description', 'image'),
                'conditions' => array('Testimonial.status' => 1),
                'limit' => $limit,
                'order' => array('Testimonial.created DESC'),
            ));
        }
        //pr($testimonials);die;
        return $testimonials;
    }

    public function calculateHeight($height_inches = 0, $height_feet = 0) {
        return (($height_feet * 12) + $height_inches);
    }

	// Get List of women based on agency
	public function womenList($agency_id = 0){
		$this->User = ClassRegistry::init('User');
		$this->paginate = array('conditions'=>array('UserProfile.agency_id' => $agency_id, 'User.role_id' => WOMAN_ID, 'User.is_deleted' => 0), 'limit'=>FRONT_PAGING);
		$this->Paginator->settings = $this->paginate;
		$womens = $this->Paginator->paginate('User');
		return $womens;
	}
	
	
	
}
