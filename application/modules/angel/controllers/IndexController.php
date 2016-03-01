<?php

class Angel_IndexController extends Angel_Controller_Action {

    protected $login_not_required = array(
        'index',
        'contact',
        'list',
        'case',
        'about');

    public function init() {
        $this->_helper->layout->setLayout('normal');
        parent::init();
    }

    public function indexAction() {
        $productModel = $this->getModel('product');

        $products = $productModel->getAll(false);

        $this->view->product = $products;
    }

    public function subscribeAction() {
        if ($this->request->isXmlHttpRequest() && $this->request->isPost()) {
            try {
                $email = $this->request->getParam("email");
                $subscribeModel = $this->getModel('subscribe');
                $subscribeModel->addSubscribe($email);
                echo 1;
                exit;
            } catch (Angel_Exception_User $e) {
                echo 0;
                exit;
            }
        } else {
            
        }
    }

    /**
     * 登录
     */
    public function loginAction() {
        if ($this->request->isPost()) {
            $this->userLogin('show-play', "登录芝士电视");
        }
        else {
            //第一次请求先判断是否移动端浏览器,如果是移动端浏览器就跳转到移动端注册页面
            if ($this->isMobile()) {
                $loginPath = $this->view->url(array(), 'phone-login') ;

                $this->_redirect($loginPath);
            }
        }
    }

    /**
     * 注册
     */
    public function registerAction() {
        if ($this->request->isPost()) {
            $this->userRegister('login', "注册芝士电视", "user");
        }
        else {
            //第一次请求先判断是否移动端浏览器,如果是移动端浏览器就跳转到移动端注册页面
            if ($this->isMobile()) {
                $registerPath = $this->view->url(array(), 'phone-register') ;

                $this->_redirect($registerPath);
            }
        }
    }

    public function isEmailCanBeUsedAction() {
        if ($this->request->isXmlHttpRequest() && $this->request->isPost()) {

            $email = $this->request->getParam('email');
            $result = false;
            try {
                $userModel = $this->getModel('user');
                $result = $userModel->isEmailExist($email);
            } catch (Angel_Exception_User $e) {
                $this->_helper->json(0);
            }
            // email已经存在返回false，不存在返回true
            $this->_helper->json($result ? false : true);
        }
    }

    public function forgotPasswordAction() {
        if ($this->request->isPost()) {
            $email = $this->request->getParam('email');
            $result = false;
            try {
                $userModel = $this->getModel('user');
                $result = $userModel->forgotPassword($email);
            } catch (Angel_Exception_User $e) {
                $this->view->error = $e->getDetail();
                $this->view->re_email = $email;
                $result = false;
            }
            if ($result) {
                $this->view->send = "success";
            }
        }
        $this->view->title = "找回密码";
    }

    public function logoutAction() {
        $this->userLogout('login');
    }

    /***********************************************
     * 案例处理代码
     *
     * *********************************************/
    public function listAction() {
        $this->_helper->layout->setLayout('main');

        $categoryModel = $this->getModel('category');
        $productModel = $this->getModel('product');

        $page = $this->getParam('page');

        if (!$page) {
            $page = 1;
        }

        $category_id = $this->getParam('category');

        if ($category_id) {
            $paginator = $productModel->getByCategory($category_id);
        }
        else {
            $paginator = $productModel->getAll(false);
        }

//        $paginator->setItemCountPerPage($this->bootstrap_options['default_page_size']);//
//        $paginator->setCurrentPageNumber($page);

        $categorys = $categoryModel->getAll(false);

//        $this->view->resource = $cases;
        $this->view->paginator = $paginator;
        $this->view->categorys = $categorys;
    }

    public function caseAction() {
        $this->_helper->layout->setLayout('main');

        $notFoundMsg = '未找到目标案例';
        $productModel = $this->getModel('product');

        $id = $this->getParam('id');

        if ($id) {
            $target = $productModel->getById($id);

            if (!$target) {
                $this->_redirect($this->view->url(array(), 'manage-result') . '?error=' . $notFoundMsg);
            }

            $this->view->model = $target;

            $products = array();

            foreach ($target->category as $c) {
                $tmp_products = $productModel->getInCategoryId($c->id);

                foreach ($tmp_products as $p) {
                    $has = false;

                    foreach ($products as $t) {
                        if ($t->id == $p->id) {
                            $has = true;

                            break;
                        }
                    }

                    if (!$has)
                        $products[] = $p;
                }
            }

            $this->view->products = $products;
        } else {
            $this->_redirect($this->view->url(array(), 'manage-result') . '?error=' . $notFoundMsg);
        }
    }

    /*******************************************************
     * 其他action
     *
     * *****************************************************/
    public function aboutAction() {
        $this->_helper->layout->setLayout('main');
    }

    public function contactAction() {
        $this->_helper->layout->setLayout('main');

        $contactModel = $this->getModel('contact');

        $result = $contactModel->getAll(false);

        $count = count($result);

        if ($count == 0) {

        }
        else {
            $id = null;

            foreach ($result as $r) {
                $id = $r->id;

                break;
            }

            $target = $contactModel->getById($id);

            $this->view->model = $target;
        }
    }
}
