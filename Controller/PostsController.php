<?php
/**
 * Provides a post-centric controler for contents
 *
 * Parbake (http://jasonsnider.com/parbake)
 * Copyright 2013, Jason D Snider. (http://jasonsnider.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2013, Jason D Snider. (http://jasonsnider.com)
 * @link http://jasonsnider.com
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package       Users
 */
App::uses('ContentsAppController', 'Contents.Controller');

/**
 * Provides a post-centric controler for contents
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package Contents
 */
class PostsController extends ContentsAppController {

    /**
     * Holds the name of the controller
     *
     * @var string
     */
    public $name = 'Posts';

    /**
     * Call the components to be used by this controller
     *
     * @var array
     */
    //public $components = array();

    /**
     * Called before action
     * @return void
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(
            'index',
            'view'
        );
        $this->Authorize->allow();
    }
    
    /**
     * The models used by the controller
     *
     * @var array
     */
    public $uses = array(
        'Contents.Content',
    );

    /**
     * Displays an index of all content
     * @return void
     */
    public function index() {

        $this->paginate = array(
            'conditions' => array(
                'Content.content_type'=>'post',
                'Content.content_status'=>'published',
            ),
            'contain'=>array(
                'CreatedUser'=>array(
                    'UserProfile'=>array()
                ),
            ),
            'order'=>'Content.created DESC',
            'limit' => 10
        );

        $this->request->checkForMeta = true;
        $data = $this->paginate('Content');
        $this->set(compact('data'));
    }
    
    /**
     * Displays content; a single page or post, etc.
     * @param string $token
     * @return void
     */
    public function view($token) {
        
        $content = $this->Content->find(
            'first',
            array(
                'conditions'=>array(
                    'or'=>array(
                        'Content.id'=>$token,
                        'Content.slug'=>$token
                    ),
                    'Content.content_type'=>'post',
                ),
                'contain'=>array(
                    'CreatedUser'=>array(
                        'UserProfile'=>array()
                    ),
                    'Tag'=>array(
                        'Tagged'=>array()
                    )
                )
            )
        );
debug($content);
        //Send the id back to the view
        $id = $content['Content']['id'];
        
        $this->request->title = $content['Content']['title'];
        
        $this->set(compact(
            'content',
            'id'
        ));
    }

}