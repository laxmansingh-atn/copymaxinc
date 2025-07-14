<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(FCPATH . 'vendor/autoload.php');

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class Index extends MY_Controller
{

    //protected $lang;
    function __construct()
    {
        parent::__construct();
        $this->load->library('encryption');
        $this->load->model('home_model');

        $this->load->model('product_model');
        if ($this->session->userdata('site_lang') == "") {
            $a_lang     = $this->config->item('lang_uri_abbr');
            $lang_code  = $this->uri->segment(1);
            $lang_value = "english";
            if (array_key_exists($lang_code, $a_lang)) {
                $lang_value = $a_lang[$lang_code];
            }
            $this->session->set_userdata('site_lang', $lang_value);
        } else {
            $a_lang    = $this->config->item('lang_uri_abbr');
            $lang_code = $this->uri->segment(1);
            if (array_key_exists($lang_code, $a_lang)) {
                $lang_value = $a_lang[$lang_code];
            }
        }
        $this->testEmail();
    }

    //Test EMail
    public function testEmail()
    {
        $data = [];
        $data['to'] = 'laxmansingh.atn@gmail.com';
        $data['subject'] = 'Test Email';
        $data['message'] = 'Test Email Body Message';
        $status = sendMail($data);
        dd($status);
    }

    //Home Page
    public function index()
    {

        //echo phpinfo(); die();
        $this->_container       = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules         = $this->config->item('modules_locations');
        $data                   = array();
        $data['page_slug']      = end($this->uri->segments);
        $data['productlist']    = $this->product_model->Show_Products();
        //echo'<pre>'; print_r($data['productlist']);die;
        $data['category_lists'] = $this->home_model->Show_Category(); //category  list
        //echo'<pre>'; print_r($data['category_lists']);die;

        $data['page_title']     = "Home";
        $data['page']           = $this->config->item('bootsshop_template_dir_welcome') . "index";
        $data['module']         = 'welcome';
        $this->load->view($this->_container, $data);
    }



    public function product_details()
    {
        $slug                       = end($this->uri->segments);
        $data['product_data']       = $this->home_model->product_details_main($slug);

        //echo $data['is_logged_in'];die();
        if (!empty($data['product_data'])) {
            $product_id = $data['product_data']['product_id'];
            $data['paper_type']         = $this->home_model->getPaperTypes($product_id);

            //echo "<pre>";print_r($data['paper_type']);die();

            $this->_container           = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
            $data['get_data']           = $this->home_model->product_printing_details($slug);
            $data['get_finishing_data'] = $this->home_model->product_finishing_details($slug);
            $data['get_dimensions']        = $this->product_model->get_product_dimensions($product_id);
            $data['page_title'] = "Home";
            if (!empty($_REQUEST['rowid'])) {
                $data['page']       = $this->config->item('bootsshop_template_dir_welcome') . "product_details_edit";
            } else {
                $data['page']       = $this->config->item('bootsshop_template_dir_welcome') . "product_details";
            }
            $data['module']     = 'welcome';
            //print_r($data); die;
            $this->load->view($this->_container, $data);
        } else {
            redirect(base_url());
        }
    }

    public function product_details_new()
    {

        $slug                       = end($this->uri->segments);
        $data['product_data']       = $this->home_model->product_details_main($slug);
        $data['slug'] = $slug;

        //echo $data['is_logged_in'];die();
        if (!empty($data['product_data'])) {
            $product_id = $data['product_data']['product_id'];
            $data['paper_type']         = $this->home_model->getPaperTypes($product_id);

            //echo "<pre>";print_r($data['paper_type']);die();

            $this->_container           = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";

            $data['get_data']           = $this->home_model->product_printing_details($slug);

            $data['get_finishing_data'] = $this->home_model->product_finishing_details($slug);
            $data['get_dimensions']		= $this->product_model->get_product_dimensions($product_id);

            $data['page_title'] = "Home";

        	if (!empty($_REQUEST['rowid'])) {

                $data['page']       = $this->config->item('bootsshop_template_dir_welcome') . "product_details_edit";
            } else {

                $data['page']       = $this->config->item('bootsshop_template_dir_welcome') . "product_details_new";
            }

            $data['module']     = 'welcome';
            //print_r($this->_container); die;

            $this->load->view($this->_container, $data);
        } else {
            redirect(base_url());
        }


    }
    public function product_details_new_sandy()
    {
        $slug                       = end($this->uri->segments);
        $data['product_data']       = $this->home_model->product_details_main($slug);

        //echo $data['is_logged_in'];die();
        if (!empty($data['product_data'])) {
            $product_id = $data['product_data']['product_id'];
            $data['paper_type']         = $this->home_model->getPaperTypes($product_id);

            //echo "<pre>";print_r($data['paper_type']);die();

            $this->_container           = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
            $data['get_data']           = $this->home_model->product_printing_details($slug);
            $data['get_finishing_data'] = $this->home_model->product_finishing_details($slug);
            $data['get_dimensions']        = $this->product_model->get_product_dimensions($product_id);
            $data['page_title'] = "Home";
            if (!empty($_REQUEST['rowid'])) {
                $data['page']       = $this->config->item('bootsshop_template_dir_welcome') . "product_details_edit";
            } else {
                $data['page']       = $this->config->item('bootsshop_template_dir_welcome') . "product_details_new_sandy";
            }
            $data['module']     = 'welcome';
            //print_r($data); die;
            $this->load->view($this->_container, $data);
        } else {
            redirect(base_url());
        }
    }

    /********************   attribute price calculator  *******************/
    // 12-12-18    

    public function price_calculator()
    {
        if ($this->input->post()) {
            //echo '<pre>' ; print_r($this->input->post()); die;
            //print_r($this->input->post());die();
            $dimensions = $this->input->post('dimensions');
            $paper_type = $this->input->post('paper_type');
            $no_of_sides = $this->input->post('no_of_sides');
            $product_id = $this->input->post('product_id');
            $no_copies = $this->input->post('no_copies');
            $no_pages = $this->input->post('no_pages');
            $divider_sheets = $this->input->post('divider_sheets');
            $stapling = $this->input->post('stapling');
            $folding = $this->input->post('folding');
            $collation = $this->input->post('collation');
            $hole_punch = $this->input->post('hole_punch');
            $full_bleed = $this->input->post('full_bleed');
            //echo $stapling;die;
            $total_paper_price = $error = $finishing = $divider_sheets_price['price'] = $stapling_price['price'] = $folding_price['price'] = $hole_punch_price['price'] = 0;

            $total_pages = $no_copies * $no_pages;
            $total_pages_bleed = $no_copies * $no_pages;

            if ($no_of_sides == "2-sided") {
                if ($no_pages % 2 == 0) {
                    $printing = $this->home_model->get_printing_price($dimensions, $no_of_sides, $product_id, $total_pages);
                    $printing_per_page = $printing['price'];
                    $total_printing = $printing_per_page * $total_pages;
                    $total_pages_bleed = ($no_copies * $no_pages) / 2;
                } else {
                    $even_pages = ($no_pages - 1) * $no_copies;
                    $even = $this->home_model->get_printing_price($dimensions, "2-sided", $product_id, $even_pages);

                    $odd_pages = 1 * $no_copies;
                    $odd = $this->home_model->get_printing_price($dimensions, "1-sided", $product_id, $odd_pages);

                    $printing_per_page = $even['price'] + $odd['price'];
                    $total_printing = ($even['price'] * $even_pages) + ($odd['price'] * $odd_pages);
                    $total_pages_bleed = ($even_pages / 2) + $odd_pages;
                }
            } else {
                $printing = $this->home_model->get_printing_price($dimensions, $no_of_sides, $product_id, $total_pages);
                $printing_per_page = $printing['price'];
                $total_printing = $printing_per_page * $total_pages;
                $total_pages_bleed = $no_copies * $no_pages;
            }

            //echo $total_printing;die();

            if ($paper_type == "20/50 lb white copy paper") {
                $paper_price = 0;
                //-------------------------------------------25/11/2019-------------------------------------//
                if ($no_of_sides == "2-sided") {
                    if ($no_pages % 2 == 0) {
                        $total_pages = ($no_copies * $no_pages) / 2;
                    } else {
                        $even_colour_page = $no_pages - 1;
                        $total_even_colour_pages = ($no_copies * $even_colour_page) / 2;

                        $odd_colour_page = 1;
                        $total_odd_colour_pages = $no_copies * $odd_colour_page;


                        $total_pages = $total_even_colour_pages + $total_odd_colour_pages;
                    }
                } else {
                    $total_pages = $no_copies * $no_pages;
                    $total_paper_price = $paper_price * $total_pages;
                }
                //----------------------------------------------END-----------------------------------------//
            } else {
                $price = $this->home_model->get_paper_price($paper_type, $product_id, $dimensions);
                if (empty($price)) {
                    $paper_price = 0;
                    $error = 1;
                } else {
                    $paper_price = $price['price'];
                    if ($no_of_sides == "2-sided") {
                        if ($no_pages % 2 == 0) {
                            $total_pages = ($no_copies * $no_pages) / 2;
                            $total_paper_price = $paper_price * $total_pages;
                        } else {
                            $even_colour_page = $no_pages - 1;
                            $total_even_colour_pages = ($no_copies * $even_colour_page) / 2;
                            $total_even_paper_price = $paper_price * $total_even_colour_pages;

                            $odd_colour_page = 1;
                            $total_odd_colour_pages = $no_copies * $odd_colour_page;
                            $total_odd_paper_price = $paper_price * $total_odd_colour_pages;

                            $total_paper_price = $total_even_paper_price + $total_odd_paper_price;
                        }
                    } else {
                        $total_pages = $no_copies * $no_pages;
                        $total_paper_price = $paper_price * $total_pages;
                    }
                }
            }

            //finishing option

            if (!empty($divider_sheets)) {
                $condition = array('attr_type' => 'divider', 'product_id' => $product_id);
                $divider_sheets_price = $this->home_model->get_finishing_price($condition);
                //echo $this->db->last_query();die;
                if (empty($divider_sheets_price['price'])) {
                    $error = 1;
                    $divider_sheets_price['price'] = 0;
                }
            }
            //print_r($divider_sheets_price);die;

            if ((!empty($stapling)) &&  $stapling != ' ') {

                if ($dimensions == '8.5x11' || $dimensions == '8.5x14') {
                    $condition = array('product_id' => $product_id, 'attr_type' => 'stapling', $no_pages . ' between range_from and `range_to`' => NULL, 'dimension' => $dimensions, 'page_side' => $no_of_sides, 'stapling_type' => $stapling, 'folding_paper_type' => $collation);
                    //print_r($condition);die();
                    $stapling_price = $this->home_model->get_finishing_price($condition);
                    //var_dump($stapling_price);
                    //echo $this->db->last_query();die;
                    if (empty($stapling_price['price'])) {
                        $error = 4;
                        $stapling_price['price'] = 0;
                    }
                } else {
                    if ($stapling) {
                        if ($stapling == "2-staple") {
                            $stapling_price['price'] = '0.20';
                        } else {
                            $stapling_price['price'] = '0.10';
                        }
                    }
                }
            }
            //print_r($stapling_price);die;

            if ((!empty($folding)) &&  $folding != ' ') {
                $condition = array('product_id' => $product_id, 'attr_type' => 'folding', 'dimension' => $dimensions, 'folding_paper_type' => $collation, 'paper_type' => $paper_type);
                $folding_price = $this->home_model->get_finishing_price($condition);
                //print_r($folding_price);die();
                if (empty($folding_price['price'])) {
                    $error = 3;
                    $folding_price['price'] = 0;
                }
            }

            if ((!empty($hole_punch)) &&  $hole_punch != ' ') {
                $condition = array('product_id' => $product_id, 'attr_type' => 'hole', 'dimension' => $dimensions, 'page_side' => $no_of_sides);
                $hole_punch_price = $this->home_model->get_finishing_price($condition);

                if (empty($hole_punch_price['price'])) {
                    $error = 2;
                }
            }

            if (empty($folding_price['price'])) {
                $total_folding_price = 0;
            } else {
                //if ($no_of_sides == "2-sided") {
                //$total_folding_pages = $total_pages / 2;
                //} else {
                //$total_folding_pages = $total_pages;
                //}
                //if (($folding_price['price'] * $total_folding_pages) < 10) {
                //$total_folding_price = 10;
                //} else {
                $total_folding_pages = $total_pages_bleed;
                $total_folding_price = $folding_price['price'] * $total_folding_pages;
                if ($total_folding_price < 10) {
                    $total_folding_price = 10;
                }
                //}
            }

            $finishing = $divider_sheets_price['price'] + $stapling_price['price'] + $hole_punch_price['price'];

            $price_per_page  = ($printing_per_page + $finishing) + $paper_price + $total_folding_price;

            $finishing_total = ($divider_sheets_price['price'] * $no_copies) + ($stapling_price['price'] * $no_copies) + ($hole_punch_price['price'] * $total_pages) + $total_folding_price;
            //echo $no_copies.'|'.$total_pages.'|'.$divider_sheets_price['price'].'|'.$stapling_price['price'].'|'.$hole_punch_price['price'].'|'.$finishing_total;die;
            $total  = ($total_printing) + ($finishing_total);

            $total_price = $total + $total_paper_price;

            if ($total_price < 1) {
                $total_price = "1.00" + $finishing_total;
            }
            //else {
            // $total_price = $total + $finishing_total ;
            // }

            if ($full_bleed == 'full-bleed') {

                if (($product_id == 114 || $product_id == 137) && $paper_type == "20/50 lb white copy paper") {
                    $full_bleed_price = 0;
                    $error = 9;
                } else {
                    $full_bleed_price = $total_pages_bleed * 0.02;
                }
            } else {
                $full_bleed_price = 0;
            }
            $total_price = $total_price + $full_bleed_price;
            echo json_encode(array(
                'price' => $price_per_page,
                'total' => $total_price,
                'error' => $error
            ));
            die();
        }
    }

    public function price_calculator_for_coil_bound_books()
    {

        if ($this->input->post()) {



            $no_copies                     = $this->input->post('no_copies');
            $no_pages                         = $this->input->post('no_pages');
            $orientation_val                 = $this->input->post('orientation-val');
            $dimensions                     = $this->input->post('dimensions');
            $no_of_sides                     = $this->input->post('no_of_sides');
            $color_coil                    = $this->input->post('color_coil');
            $paper_type                    = $this->input->post('paper_type');
            $no_pages                        = $this->input->post('no_pages');
            $front_cover_check                = $this->input->post('front_cover_check');
            $front_cover_sides                = $this->input->post('front_cover_sides');
            $front_cover_color                = $this->input->post('front_cover_color');
            $front_cover_paper_type        = $this->input->post('front_cover_paper_type');
            $front_cover_full_bleed        = $this->input->post('front_cover_full_bleed');
            $back_cover_check                = $this->input->post('back_cover_check');
            $back_cover_sides                = $this->input->post('back_cover_sides');
            $back_cover_color_type            = $this->input->post('back_cover_color_type');
            $back_cover_paper_type            = $this->input->post('back_cover_paper_type');
            $back_cover_full_bleed            = $this->input->post('back_cover_full_bleed');
            $back_cover_option                = $this->input->post('back_cover_option');
            $full_bleed                    = $this->input->post('full_bleed');
            $front_cover_option            = $this->input->post('front_cover_option');
            $product_id                     = $this->input->post('product_id');
            $no_sheets                     = "";


            if ($orientation_val == "Landscape") {


                $dimensions = implode("x", array_reverse(explode("x", $dimensions)));
            }


            $total_pages = 0;
            $total_pages_bleed = $no_copies * $no_pages;
            $inside_pages = "";



            /* if($no_pages % 2 != 0 && $no_of_sides == "2-sided"){

				$inside_pages = $no_pages;
				$inside_pages++;
				$no_sheets = $inside_pages/2;
				$total_pages = $no_copies*$no_sheets;
				
			} */

            if ($no_of_sides == "2-sided") {
                $inside_pages = $no_pages;
                $no_sheets = $inside_pages / 2;
                $total_pages = $no_copies * $inside_pages;
            } else {

                $inside_pages = $no_pages;
                $no_sheets = $no_pages;
                $total_pages = $no_copies * $no_pages;
                //echo $total_pages. ' -total_pages'."<br>";

            }



            if ($paper_type != "20/50 lb white copy paper") {

                if (($paper_type == "24/60 lb white copy paper" && $color_coil == "black-ink") && ($dimensions == "8.5x11" || $dimensions == "8x8" || $dimensions == "8x10")) {

                    $inside_product_paper_price = "0.016";
                } elseif (($paper_type == "24/60 lb white copy paper" && $color_coil == "color") && ($dimensions == "8.5x11" || $dimensions == "8x8" || $dimensions == "8x10")) {

                    $inside_product_paper_price = "0.0175";
                } elseif (($paper_type == "24/60 lb white copy paper" && $color_coil == "color") && ($dimensions == "8.5x5.5" || $dimensions == "5*7")) {

                    $inside_product_paper_price = "0.011";
                } elseif (($paper_type == "28/70 lb white copy paper" && $color_coil == "color") && ($dimensions == "8.5x5.5" || $dimensions == "5*7")) {

                    $inside_product_paper_price = "0.0125";
                } else {

                    $inside_product_paper_price = $this->home_model->get_product_paper($product_id, $paper_type, $dimensions);
                }
            } else {
                $inside_product_paper_price = 0;
            }



            $inside_pages_price = $this->home_model->get_inside_page_price($no_of_sides, $color_coil, $paper_type, $product_id, $total_pages, $dimensions);



            /* echo $total_pages."<br>";
			 
			 echo $inside_pages_price['price'];
			 die(); */

            $inside_pages_price_final = $total_pages * $inside_pages_price['price'];
            $inside_product_paper_price_final = $inside_product_paper_price * ($no_copies * $no_sheets);

            if ($no_of_sides == "2-sided" && $inside_pages % 2 != 0) {

                $no_sheets_for_binding = (int)$no_sheets;
                $no_sheets_for_binding++;
            } else {

                $no_sheets_for_binding = (int)$no_sheets;
            }
            $binding_cost = $this->home_model->get_binding_price($no_sheets_for_binding, $product_id, $no_copies);


            $final_inside_pages_price =  $inside_pages_price_final + $inside_product_paper_price_final + $binding_cost;


            if ($front_cover_check == "yes") {
                //$no_sheets++;
                //$total_pages = $no_copies*1;

                /* echo $front_cover_sides ."<br>".$front_cover_color ."<br>".$product_id."<br>".$no_copies."<br>".$dimensions;
				
				die("babak"); */

                if ($front_cover_sides == "2-sided") {

                    $front_cover_print_price = $this->home_model->get_inside_page_price($front_cover_sides, $front_cover_color, "20/50 lb white copy paper", $product_id, ($no_copies * 2), $dimensions);
                } else {



                    $front_cover_print_price = $this->home_model->get_inside_page_price($front_cover_sides, $front_cover_color, "20/50 lb white copy paper", $product_id, $no_copies, $dimensions);
                }

                if ($front_cover_paper_type != "20/50 lb white copy paper" && $front_cover_paper_type != "24/60 lb white copy paper" && $front_cover_paper_type != "28/70 lb white copy paper") {

                    $product_paper_price = $this->home_model->get_product_paper($product_id, $front_cover_paper_type, $dimensions);

                    /* 	echo "<pre>";
				print_r($product_paper_price);
				die(); */
                } else {

                    $product_paper_price = 0;
                }



                /* $front_cover_price = $this->home_model->get_fornt_cover_price($front_cover_sides,$front_cover_color,$front_cover_paper_type,$product_id,$total_pages,$dimensions);

				$front_cover_price['price'] = (float)$front_cover_price['price']; */

                if ($front_cover_sides == "2-sided") {

                    /* echo "<pre>";
					print_r($front_cover_print_price['price']);
					die(); */



                    $front_cover_price = (float)(($product_paper_price * ($no_copies)) + ($front_cover_print_price['price'] * ($no_copies * 2)));
                } else {

                    $front_cover_price = (float)(($product_paper_price * $no_copies) + ($front_cover_print_price['price'] * $no_copies));
                } //$front_cover_price['price'] = ($front_cover_price['price']+$product_paper_price)*$total_pages;
            } else {

                $front_cover_price = 0;
            }

            /* echo $front_cover_price;
				die("babak"); */

            if ($back_cover_check == "yes") {


                if ($back_cover_sides == "2-sided") {

                    $back_cover_print_price = $this->home_model->get_inside_page_price($back_cover_sides, $back_cover_color_type, "20/50 lb white copy paper", $product_id, ($no_copies * 2), $dimensions);
                } else {

                    $back_cover_print_price = $this->home_model->get_inside_page_price($back_cover_sides, $back_cover_color_type, "20/50 lb white copy paper", $product_id, $no_copies, $dimensions);
                }


                if ($back_cover_paper_type != "20/50 lb white copy paper" && $back_cover_paper_type != "24/60 lb white copy paper" && $back_cover_paper_type != "28/70 lb white copy paper") {

                    $product_paper_price = $this->home_model->get_product_paper($product_id, $back_cover_paper_type, $dimensions);
                } else {

                    $product_paper_price = 0;
                }



                if ($back_cover_sides == "2-sided") {

                    /* echo $product_paper_price;
					die(); */

                    $back_cover_price = (float)(($product_paper_price * ($no_copies)) + ($back_cover_print_price['price'] * ($no_copies * 2)));
                } else {

                    $back_cover_price = (float)(($product_paper_price * $no_copies) + ($back_cover_print_price['price'] * $no_copies));
                }
            } elseif ($back_cover_check == "yes_but_blank_cover_only") {



                if ($back_cover_paper_type != "20/50 lb white copy paper" && $back_cover_paper_type != "24/60 lb white copy paper" && $back_cover_paper_type != "28/70 lb white copy paper") {

                    $product_paper_price = $this->home_model->get_product_paper($product_id, $back_cover_paper_type, $dimensions);
                } else {

                    $product_paper_price = 0;
                }



                //$back_cover_price = $this->home_model->get_back_cover_price($back_cover_sides,$back_cover_color_type,$back_cover_paper_type,$product_id,$total_pages,$dimensions);

                //$back_cover_price['price'] = (float)$back_cover_price['price'];
                $product_paper_price = (float)$product_paper_price;

                $back_cover_price = $product_paper_price * $no_copies;
            } else {


                $back_cover_price = 0;
            }





            if ($back_cover_option != "None") {


                $back_cover_cost = $this->home_model->get_back_cover_option_price($back_cover_option, $product_id);
                $back_cover_option_final = $back_cover_cost['price'] * $no_copies;
            } else {

                $back_cover_option_final = 0;
            }



            if ($front_cover_option != "None") {


                $front_cover_cost = $this->home_model->get_front_cover_option($front_cover_option, $product_id);

                $front_cover_option_final = $front_cover_cost['price'] * $no_copies;
            } else {

                $front_cover_option_final = 0;
            }


            $binding_cost = $this->home_model->get_binding_price($no_sheets, $product_id, $no_copies);

            if ($full_bleed == "full-bleed") {

                if ($no_of_sides == "2-sided") {

                    $final_bleed_cost = ($no_pages / 2) * $no_copies * 0.02;
                } else {

                    $final_bleed_cost = $no_pages * $no_copies * 0.02;
                }
            } else {

                $final_bleed_cost = 0;
            }


            if ($front_cover_full_bleed == "full-bleed") {

                if ($front_cover_sides == "2-sided") {

                    $final_bleed_cost_front = 1 * $no_copies * 0.02;
                } else {

                    $final_bleed_cost_front = 1 * $no_copies * 0.02;
                }
            } else {

                $final_bleed_cost_front = 0;
            }


            if ($back_cover_full_bleed == "full-bleed") {

                if ($back_cover_sides == "2-sided") {

                    $final_bleed_cost_back = 1 * $no_copies * 0.02;
                } else {

                    $final_bleed_cost_back = 1 * $no_copies * 0.02;
                }
            } else {

                $final_bleed_cost_back = 0;
            }

            if ($front_cover_price == 0) {

                $final_bleed_cost_front = 0;
            }

            if ($back_cover_price == 0) {

                $final_bleed_cost_back = 0;
            }


            /* $inside_pages_price['price']*($no_copies*$inside_pages) */




            /* $total = $front_cover_price['price']+$inside_pages_price['price']*($no_copies*$inside_pages)+$back_cover_price['price']+$back_cover_cost['price']+$front_cover_cost['price']+$binding_cost+$bleed_cost_for_inside_pages; */


            $total = $front_cover_price + $final_inside_pages_price + $back_cover_price + $back_cover_option_final + $front_cover_option_final + $final_bleed_cost + $final_bleed_cost_front + $final_bleed_cost_back;

            //$total = (int)$total;

            echo json_encode(array(
                'price' => $total,
                'total' => $total,
                'front_cover' => $front_cover_price,
                'inside_page' => $final_inside_pages_price,
                'back_cover' => $back_cover_price,
                'back_cover_cost' => $back_cover_option_final,
                'front_cover_cost' => $front_cover_option_final


            ));

            /*  echo json_encode(array(
                'price' => $final_inside_pages_price,
                'total' => $final_inside_pages_price
          
            )); */
            die();
        }

        //die("here!!");



    }

    public function get_cart_item()
    {
        if ($this->input->post()) {
            $data['rowid'] = $this->input->post('rowid');
            $this->load->view('ajax/ajax_cart_item', $data);
        }
    }


    public function image_upload()
    {


        $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $slug             = end($this->uri->segments);

        // $details = $this->session->userdata('product_details');

        if ($this->input->post()) {
            $details = $this->input->post();
        }
        //print_r($details) ;  exit() ; 
        //print_r($this->input->post());die;
        $data['details']    = $details;
        $data['page_title'] = "Home";
        $data['page']       = $this->config->item('bootsshop_template_dir_welcome') . "product_file_upload";
        $data['module']     = 'welcome';
        //print_r($data); die;
        $this->load->view($this->_container, $data);
    }

    //sandy 14-05-2021
    public function image_upload_new()
    {


        $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $slug = end($this->uri->segments);

        // $details = $this->session->userdata('product_details');

        if ($this->input->post()) {
            $details = $this->input->post();
        }
        //print_r($details) ;  exit() ; 
        //print_r($this->input->post());die;
        $data['details'] = $details;
        $data['page_title'] = "Home";
        $data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "product_file_upload_updated";
        $data['module'] = 'welcome';
        //print_r($data); die;
        $this->load->view($this->_container, $data);
    }

    //sandy 03-01-2021
    public function image_upload_new_1()
    {

        $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout_1.php";
        // $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $slug = end($this->uri->segments);

        // $details = $this->session->userdata('product_details');

        if ($this->input->post()) {
            $details = $this->input->post();
        }
        //print_r($details) ;  exit() ; 
        //print_r($this->input->post());die;
        $data['details'] = $details;
        $data['page_title'] = "Home";
        $data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "product_file_upload_updated";
        $data['module'] = 'welcome';
        //print_r($data); die;
        $this->load->view($this->_container, $data);
    }

    public function contact_us()
    {
        //echo get_current_language(); die;
        $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules   = $this->config->item('modules_locations');

        $data                 = array();
        $page_slug            = 'contact-us';
        $data['page_slug']    = $page_slug;
        $data['page_content'] = $this->home_model->Show_Page_Content($page_slug, get_current_language());

        //print_r($data['page_content']);

        $data['page_title'] = "Contact Us";
        $data['page']       = $this->config->item('bootsshop_template_dir_welcome') . "contactus";
        $data['module']     = 'welcome';

        //echo "<pre>";print_r($data['content']);exit();

        $this->load->view($this->_container, $data);
    }
    //CMS Page(s)
    public function cms_page()
    {
        //echo get_current_language(); 
        # Get the third segment
        $page_slug        = end($this->uri->segments);
        $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules   = $this->config->item('modules_locations');
        $data                 = array();
        $data['page_slug']    = $page_slug;
        $data['page_content'] = $this->home_model->Show_Page_Content($page_slug, get_current_language());


        $data['page_title'] = $page_slug;
        $data['page']       = $this->config->item('bootsshop_template_dir_welcome') . "cms";
        $data['module']     = 'welcome';

        //echo "<pre>";print_r($data['page_content']);exit();

        $this->load->view($this->_container, $data);
    }
    //Our Products Page
    public function products_listing()
    {
        $this->_container       = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules         = $this->config->item('modules_locations');
        $data                   = array();
        $data['page_slug']      = end($this->uri->segments);
        //$data['header_content']  = $this->home_model->Show_Page(get_current_language());        
        //$data['banner_list']    = $this->home_model->Show_Banner('home',get_current_language() );     //banner list
        //$data['brand_list']    = $this->home_model->Show_Brands(get_current_language());     //brands list
        $data['category_lists'] = $this->home_model->Show_Category(); //category  list
        $data['productlist']    = $this->product_model->Show_Products();
        //print_r($data['productlist']); die;
        $data['page_title']     = "Home";
        $data['page']           = $this->config->item('bootsshop_template_dir_welcome') . "products";
        $data['module']         = 'welcome';
        //print_r($data); die;
        $this->load->view($this->_container, $data);
    }
    // Product Search 
    public function search_product_frm()
    {
        $this->_container       = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules         = $this->config->item('modules_locations');
        $data                   = array();
        $data['page_slug']      = end($this->uri->segments);
        $data['category_lists'] = $this->home_model->Show_Category(); //category  list
        $data['productlist']    = $this->product_model->Show_search_Products($_REQUEST['search_product_txt']);
        //print_r($data['productlist']); die;
        $data['page_title']     = "Home";
        $data['page']           = $this->config->item('bootsshop_template_dir_welcome') . "products";
        $data['module']         = 'welcome';
        //print_r($data); die;
        $this->load->view($this->_container, $data);
    }

    // Contact mail

    public function contactsendemail()
    {

        $arc_mail_ids1 = array("info@copymaxinc.com", "sales@copymaxinc.com", "copymaxinc@gmail.com");

        if ($_POST['from_email'] && $_POST['emailTo'] && in_array($_POST['emailTo'], $arc_mail_ids1) && $_POST['subject'] && $_POST['message']) {

            /* Email to Admin */
            $data['to'] =  $_POST['emailTo'];
            //$data['to'] =  "amitava.rc25@gmail.com";
            $data['subject'] = "New Enquiry (" . $_POST['subject'] . ")";
            $data['message'] = "<p><strong>Name:</strong>" . $_POST['from_name'] . "</p><p><strong>Phone No:</strong>" . $_POST['from_phone_no'] . "</p><p><Strong>Email From</strong>: " . $_POST['from_email'] . "</p><p><strong>Message:</strong>" . $_POST['message'] . "</p>";
            $data['from'] = $_POST['from_email'];

            $this->sendContactUsMail($data);

            $name  = $_POST['from_name'];
            $email = $_POST['from_email'];
            $message = '<body style="padding: 0;margin: 0;background-color: #fff;font-family: "Open Sans", sans-serif;">
                          <table width="100%" align="center">
                           <tbody>
                        <tr>
                        <td>
                        <table style="width: 100%; margin: 35px auto;" align="center">
                        <tbody>
                        <tr>
                        <td style="color: #000;">

                        <table style="border-top: 10px solid #d6d9d8;border-left: 10px solid #d6d9d8;border-right: 10px solid #d6d9d8;width: 100%;">
                        <tbody>
                        <tr>
                        <td>
                        <div style="text-align:center;padding: 45px 0 0 0;">
                            <img src="' . base_url('assets/frontend/images/logo.png') . '" alt="logo" style="width:200px">
                        </div>
                        </td>
                        </tr>
                        <tr>
                        <td style="text-align: center;color: #045393;font-size: 15px;font-weight: 600;padding: 10px 0;font-family:Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana,sans-serif">
                        <p><span style="color: #000;">Thank you for contacting us ' . $name . '.</span></p>
                        <p><span style="color: #000;">We will get back to you soon.</span></p>
                        

                        <div style="width: 160px;margin: 3px auto 15px auto;height: 1px; background-color: #d1d1d1;"></div>
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <div style="margin: 0 45px;font-family:Arial !important;font-size: 18px">
                       
                        </div>
                        </td>
                        </tr>
                        </tbody>
                        </table>
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <table  style="background-color: #313232;width: 100%;text-align: center;color: #fff;font-family:Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana,sans-serif;font-size: 13px;padding: 17px 0;">
                        <tr>
                            <td>
                            
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ©2020 Copymax Inc. All rights reserved.
                            </td>
                        </tr>
                        </table>

                        </td>
                        </tr>
                        </tbody>
                        </table>
                        </td>
                        </tr>
                        </tbody>
                   </table></body>';

            $data['to']         = safe_trim($email);
            $data['subject']    = "(New Enquiry)";
            $data['message']    = $message;
            $data['from']       = "query@copymaxinc.com";

            $is_sendmail        = $this->sendContactUsMail($data);
            if ($is_sendmail) {
                $this->session->set_flashdata('success_message', '<strong>Thank You</strong> for contacting us.');
            } else {
                $this->session->set_flashdata('error_message', 'Something Went Wrong.');
            }

            /* End Of Email */
        }

        redirect('/');
    }


    // Contact us submit
    public function contact_us_add()
    {
        $segments  = $this->uri->total_segments();
        $lang_code = get_current_language(); // Helper "current_language_helper.php"
        if (isset($_POST['submit'])) {
            //print_r($_POST);  die;
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required');

            //print_r($data);
            $insert_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'phone_no' => $this->input->post('phone_no'),
                'subject' => $this->input->post('subject'),
                'message' => $this->input->post('message'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->db->insert('tbl_contact_us', $insert_data);
            ## Mail to Customer############### 
            $name  = $this->input->post('first_name');
            $phone = $this->input->post('phone_no');
            $email = $this->input->post('email');
            $mesg  = $this->input->post('message');



            $message = '<body style="padding: 0;margin: 0;background-color: #fff;font-family: "Open Sans", sans-serif;">
                          <table width="100%" align="center">
                           <tbody>
                        <tr>
                        <td>
                        <table style="width: 100%; margin: 35px auto;" align="center">
                        <tbody>
                        <tr>
                        <td style="color: #000;">

                        <table style="border-top: 10px solid #d6d9d8;border-left: 10px solid #d6d9d8;border-right: 10px solid #d6d9d8;width: 100%;">
                        <tbody>
                        <tr>
                        <td>
                        <div style="text-align:center;padding: 45px 0 0 0;">
                            <img src="' . base_url('assets/frontend/images/logo.png') . '" alt="logo" style="width:200px">
                        </div>
                        </td>
                        </tr>
                        <tr>
                        <td style="text-align: center;color: #045393;font-size: 15px;font-weight: 600;padding: 10px 0;font-family:Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana,sans-serif">
                        <p><span style="color: #000;">Thank you for contacting us ' . $name . '.</span></p>
                        <p><span style="color: #000;">We will get back to you soon.</span></p>
                        

                        <div style="width: 160px;margin: 3px auto 15px auto;height: 1px; background-color: #d1d1d1;"></div>
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <div style="margin: 0 45px;font-family:Arial !important;font-size: 18px">
                       
                        </div>
                        </td>
                        </tr>
                        </tbody>
                        </table>
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <table  style="background-color: #313232;width: 100%;text-align: center;color: #fff;font-family:Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana,sans-serif;font-size: 13px;padding: 17px 0;">
                        <tr>
                            <td>
                            
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ©2020 Copymax Inc. All rights reserved.
                            </td>
                        </tr>
                        </table>

                        </td>
                        </tr>
                        </tbody>
                        </table>
                        </td>
                        </tr>
                        </tbody>
                   </table></body>';

            $data['to'] = $email;
            $data['name'] = 'Copymax Inc.';
            $data['subject'] = 'contact Us';
            $data['message'] = $message;
            $data['from'] = EMAIL_SMTP_FROM_EMAIL;

            if ($this->sendMailContactUs($data)) {
                $this->session->set_flashdata('success_message', '<strong>Thank You</strong> for contacting us.');
            } else {
                $this->session->set_flashdata('error_message', 'Something Went Wrong.');
            }

            ### Mail to Admin ############### 
            $emailData = [
                'logo'         => base_url('assets/frontend/images/logo.png'),
                'description'  => $this->input->post('message'),
                'subject'      => $this->input->post('subject'),
                'full_name'    => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
                'phone'        => $this->input->post('phone_no'),
                'email'        => $this->input->post('email'),
                'current_year' => date('Y')
            ];

            // Load the email template with parsed variables
            $mail_temp = $this->load->view('emails/contact_us_template', $emailData, true);
            $data['to'] = 'copymaxinc@gmail.com';
            //$data['to']='amitava.rc25@gmail.com';
            $data['name'] = 'Copymax Inc.';
            $data['subject'] = 'Copymax Inc-Contact Us';
            $data['message'] = $mail_temp;
            $data['from'] = EMAIL_SMTP_FROM_EMAIL;
            $this->sendMailContactUs($data);
        }

        redirect('welcome/index/contact_us', 'refresh');
    }

    // login register 

    public function newsletter_submit_form()
    {
        $newsletter_email = $_REQUEST['newsletter_email'];
        $newsletter_name = $_REQUEST['newsletter_name'];
        $newsletter_signup_data['newsletter_email'] = $newsletter_email;
        $newsletter_signup_data['newsletter_name'] = $newsletter_name;
        $newsletter_signup_data['created_ts'] = date('Y-m-d H:i:s');
        $this->load->model('newsletter');
        $this->newsletter->signUp($newsletter_signup_data);
        //$data['to'] = 'amitava.rc25@gmail.com';
        $data['to'] = 'copymaxinc@gmail.com';
        $data['name'] = 'Hi';
        $data['subject'] = 'Newsletter Signup';
        $data['message'] = "<p> A new Newsletter sign Up from <a href='https://www.copymaxinc.com/'>https://www.copymaxinc.com/</a></p>			<p>Email Id: $newsletter_email</p>	 <p>Name : $newsletter_name</p>	";
        $data['from'] = EMAIL_SMTP_FROM_EMAIL;
        $this->sendMailContactUs($data);
        $this->session->set_flashdata('success_message_newsletter', 'Newsletter signup request submitted successfully');
        if ($_REQUEST['redirect_url']) {
            redirect($_REQUEST['redirect_url']);
        } else {
            redirect('index');
        }
    }

    public function login_register()
    {
        //$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout/layout_cart";
        $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules   = $this->config->item('modules_locations');

        $data = array();
        //echo "<pre>"; print_r($this->input->post());       
        //$page =  htmlentities(end($this->uri->segments)); exit() ; 
        //category  list
        if ($this->ion_auth->logged_in()) {
            $data['user_id'] = $this->ion_auth->get_user_id();
            $user            = $this->ion_auth->user()->row();
            $data['user']    = $user;
        }
        $data['signup_or_login_open'] = '';
        if (isset($_POST['user_register'])) {
            $data['signup_or_login_open'] = 'signup';
            $users_arr = $this->home_model->getAllUsers();
            $status    = 1;
            $group_id  = 2;

            $this->form_validation->set_rules('reg_email', 'Email', 'trim|required');
            $this->form_validation->set_rules('reg_password', 'Password', 'trim|required');
            $this->form_validation->set_rules('reg_confirm_password', 'Confirm Password', 'trim|required|matches[reg_password]');

            $isExists = false;

            if ($this->form_validation->run() != FALSE) {
                foreach ($users_arr as $user) {
                    //echo $users['email']."<br />";
                    if ($user['email'] == $this->input->post('reg_email')) {
                        $isExists = true;
                        break;
                    } else {
                        $isExists = false;
                    }
                }

                //echo $isExists;
                if ($isExists != true) {

                    //if($this->ion_auth->register('', $this->input->post('reg_password'), $this->input->post('reg_email'), array('username'=>$this->input->post('reg_username')), array('2')) != FALSE)
                    if ($this->ion_auth->register('', $this->input->post('reg_password'), $this->input->post('reg_email'), array(
                        'first_name' => $this->input->post('f_name'),
                        'last_name' => $this->input->post('l_name'),
                        'phone' => $this->input->post('phone')
                    ), array(
                        '2'
                    )) != FALSE) {

                        $name = $this->input->post('f_name') . ' ' . $this->input->post('l_name');
                        /* mail templete */

                        $message = '<body style="padding: 0;margin: 0;background-color: #fff;font-family: "Open Sans", sans-serif;">
                          <table width="100%" align="center">
                           <tbody>
                        <tr>
                        <td>
                        <table style="width: 600px; margin: 35px auto;" align="center">
                        <tbody>
                        <tr>
                        <td style="color: #000;">

                        <table style="border-top: 10px solid #d6d9d8;border-left: 10px solid #d6d9d8;border-right: 10px solid #d6d9d8;width: 100%;">
                        <tbody>
                        <tr>
                        <td>
                        <div style="text-align:center;padding: 45px 0 0 0;">
                            <img src="' . base_url() . 'assets/frontend/images/logo.png" alt="logo" style="width:200px">
                        </div>
                        </td>
                        </tr>
                        <tr>
                        <td style="text-align: center;color: #045393;font-size: 15px;font-weight: 600;padding: 10px 0;font-family:Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana,sans-serif">
                        <p><b>Welcome </b><span style="color: #000;"> ' . $name . '</span></p>
                        

                        <div style="width: 160px;margin: 3px auto 15px auto;height: 1px; background-color: #d1d1d1;"></div>
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <div style="margin: 0 45px;font-family:Arial !important;font-size: 18px">
                        <pre style="color: #000;font-size: 16px;line-height: 22px;margin: 0 0 20px 0;font-family:Lucida Grande,Lucida Sans Unicode,Lucida Sans,DejaVu Sans,Verdana,sans-serif;">
                          <p>Thank You for registering with us. Will get back to you soon </p>
                          <p><a>Website URL: ' . base_url() . ' </a></p>
                          <p> Contact No : 1-844-Copymax (2679629)</p>

                        </pre>
                        </div>
                        </td>
                        </tr>
                        </tbody>
                        </table>

                        <table  style="background-color: #313232;width: 100%;text-align: center;color: #fff;font-family:Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana,sans-serif;font-size: 13px;padding: 17px 0;">
                        <tr>
                        <td>
                        ' . date('Y') . ' Copymax Inc. since ' . date('Y') . '
                        </td>
                        </tr>
                        <tr>
                        <td>
                        ©' . date('Y') . ' Copymax Inc. All rights reserved.
                        </td>
                        </tr>
                        </table>

                        </td>
                        </tr>
                        </tbody>
                        </table>
                        </td>
                        </tr>
                        </tbody>
                   </table></body>';

                        $data['to'] = $this->input->post('reg_email');
                        //$data['to']='arindam.biswas@met-technologies.com';
                        //$data['to']='arindam.biswas@met-technologies.com,shubhadeep.chowdhury@met-technologies.com';
                        $data['name'] = 'Copymax Inc.';
                        $data['subject'] = 'Register with Copymax Inc.';
                        $data['message'] = $message;

                        $this->sendMail($data);
                        $this->session->set_flashdata('success_message', '<strong>Thank You</strong> for registering with  us.');
                        /* end mail templete */

                        //-------------------------------------------------Auto Login-------------------------------------//
                        $remember = (bool) $this->input->post('remember');
                        if ($this->ion_auth->login($this->input->post('reg_email'), $this->input->post('reg_password'), $remember)) {
                            $user         = $this->ion_auth->user()->row();
                            $data['user'] = $user;
                            $this->session->set_flashdata('message', $this->ion_auth->messages());

                            //Cart Session Update
                            $this->insert_cart_db_common(); //sandy 14-05-2021
                            /*$cart_contents = $this->cart->contents();

                            if (!empty($cart_contents)) {

                                $this->cart->destroy();

                                $user_id = $this->ion_auth->get_user_id();
                                $arr     = $arr1 = $arr_session = array();
                                foreach ($cart_contents as $row) {

                                    $arr['user_id']           = $user_id;
                                    $arr['product_id']        = $row['product_id'];
                                    $arr['name']              = $row['name'];
                                    $arr['image']             = $row['image'];
                                    $arr['price']             = $row['price'];
                                    $arr['qty']               = $row['qty'];
                                    $arr['priniting_details'] = $row['priniting_details'];
                                    $arr['finishing_details'] = $row['finishing_details'];
                                    $arr['copies']            = $row['copies'];
                                    $arr['pages']             = $row['pages'];
                                    $arr['created_on']        = date('Y-m-d H:i:s');
                                    $arr['updated_on']        = date('Y-m-d H:i:s');
                                    $arr['status']            = 1;
									$arr['product_slug'] 	  = $row['product_slug']; //sandy 22-04-2021
									
                                    $this->db->insert('tbl_cart', $arr);

                                    $arr['id']                = $row['product_id'];
                                    $this->cart->insert($arr);
                                }

                                //echo "<pre>";print_r($this->cart->contents());die();
                            }*/

                            if (count($this->cart->contents()) > 0) {
                                redirect(base_url('manage-addresses'));
                            } else {
                                redirect(base_url('manage-addresses'));
                            }
                        }
                        //--------------------------------------------------------End of auto login----------------------------------------------------------------//
                    }
                } else {
                    $this->session->set_flashdata('message', 'User already exists...');
                }
            } else {
                $this->session->set_flashdata('message', 'Please Insert proper data...');
            }
        }
        if (isset($_POST['user_login'])) {
            $data['signup_or_login_open'] = 'login';
            $this->form_validation->set_rules('username', 'Username|Email', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if ($this->form_validation->run() == true) {
                $remember = (bool) $this->input->post('remember');
                if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember)) {
                    $user         = $this->ion_auth->user()->row();
                    $data['user'] = $user;
                    $this->session->set_flashdata('message', $this->ion_auth->messages());

                    //Cart Session Update
                    $this->insert_cart_db_common(); //sandy 14-05-2021

                    /*$cart_contents = $this->cart->contents();

                    if (!empty($cart_contents)) {

                        $this->cart->destroy();

                        $user_id = $this->ion_auth->get_user_id();
                        $arr     = $arr1 = $arr_session = array();
                        foreach ($cart_contents as $row) {

                            $arr['user_id']           = $user_id;
                            $arr['product_id']        = $row['product_id'];
                            $arr['name']              = $row['name'];
                            $arr['image']             = $row['image'];
                            $arr['price']             = $row['price'];
                            $arr['qty']               = $row['qty'];
                            $arr['priniting_details'] = $row['priniting_details'];
                            $arr['finishing_details'] = $row['finishing_details'];
                            $arr['copies']            = $row['copies'];
                            $arr['pages']             = $row['pages'];
                            $arr['created_on']        = date('Y-m-d H:i:s');
                            $arr['updated_on']        = date('Y-m-d H:i:s');
                            $arr['status']            = 1;
							$arr['product_slug'] 	  = $row['product_slug']; //sandy 22-04-2021

                            $this->db->insert('tbl_cart', $arr);

                            $arr['id']                = $row['product_id'];
                            $this->cart->insert($arr);
                        }

                        //echo "<pre>";print_r($this->cart->contents());die();
                    }*/
                    //redirect(base_url('manage-addresses'));

                    if (count($this->cart->contents()) > 0) {
                        redirect(base_url('manage-addresses'));
                    } else {
                        redirect(base_url('manage-addresses'));
                    }
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                }
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
            }
        }

        //echo "<pre>";print_r($data);exit();
        $data['page_slug'] = end($this->uri->segments);


        $data['page_title'] = "Login & Registration";
        $data['page']       = $this->config->item('bootsshop_template_dir_welcome') . "login";
        $data['module']     = 'welcome';

        $this->load->view($this->_container, $data);
    }


    public function login_register_1()
    {
        //$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout/layout_cart";
        $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules   = $this->config->item('modules_locations');
        //$this->insert_cart_db_common();die;
        $data = array();
        //echo "<pre>"; print_r($this->input->post());       
        //$page =  htmlentities(end($this->uri->segments)); exit() ; 
        //category  list
        if ($this->ion_auth->logged_in()) {
            $data['user_id'] = $this->ion_auth->get_user_id();
            $user            = $this->ion_auth->user()->row();
            $data['user']    = $user;
        }

        if (isset($_POST['user_register_hid'])) {

            $users_arr = $this->home_model->getAllUsers();
            $status    = 1;
            $group_id  = 2;

            $this->form_validation->set_rules('reg_email', 'Email', 'trim|required');
            $this->form_validation->set_rules('reg_password', 'Password', 'trim|required');
            $this->form_validation->set_rules('reg_confirm_password', 'Confirm Password', 'trim|required|matches[reg_password]');

            $isExists = false;

            if ($this->form_validation->run() != FALSE) {
                foreach ($users_arr as $user) {
                    //echo $users['email']."<br />";
                    if ($user['email'] == $this->input->post('reg_email')) {
                        $isExists = true;
                        break;
                    } else {
                        $isExists = false;
                    }
                }

                //echo $isExists;
                if ($isExists != true) {

                    //if($this->ion_auth->register('', $this->input->post('reg_password'), $this->input->post('reg_email'), array('username'=>$this->input->post('reg_username')), array('2')) != FALSE)
                    if ($this->ion_auth->register('', $this->input->post('reg_password'), $this->input->post('reg_email'), array(
                        'first_name' => $this->input->post('f_name'),
                        'last_name' => $this->input->post('l_name'),
                        'phone' => $this->input->post('phone')
                    ), array(
                        '2'
                    )) != FALSE) {

                        $name = $this->input->post('f_name') . '' . $this->input->post('l_name');
                        /* mail templete */

                        $message = '<body style="padding: 0;margin: 0;background-color: #fff;font-family: "Open Sans", sans-serif;">
                          <table width="100%" align="center">
                           <tbody>
                        <tr>
                        <td>
                        <table style="width: 600px; margin: 35px auto;" align="center">
                        <tbody>
                        <tr>
                        <td style="color: #000;">

                        <table style="border-top: 10px solid #d6d9d8;border-left: 10px solid #d6d9d8;border-right: 10px solid #d6d9d8;width: 100%;">
                        <tbody>
                        <tr>
                        <td>
                        <div style="text-align:center;padding: 45px 0 0 0;">
                            <img src="' . base_url() . 'assets/frontend/images/logo.png" alt="logo" style="width:200px">
                        </div>
                        </td>
                        </tr>
                        <tr>
                        <td style="text-align: center;color: #045393;font-size: 15px;font-weight: 600;padding: 10px 0;font-family:Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana,sans-serif">
                        <p><b>Welcome </b><span style="color: #000;"> ' . $name . '</span></p>
                        

                        <div style="width: 160px;margin: 3px auto 15px auto;height: 1px; background-color: #d1d1d1;"></div>
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <div style="margin: 0 45px;font-family:Arial !important;font-size: 18px">
                        <pre style="color: #000;font-size: 16px;line-height: 22px;margin: 0 0 20px 0;font-family:Lucida Grande,Lucida Sans Unicode,Lucida Sans,DejaVu Sans,Verdana,sans-serif;">
                          Thank You for registering with us. Will get back to you soon </p>

                        </pre>
                        </div>
                        </td>
                        </tr>
                        </tbody>
                        </table>

                        <table  style="background-color: #313232;width: 100%;text-align: center;color: #fff;font-family:Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana,sans-serif;font-size: 13px;padding: 17px 0;">
                        <tr>
                        <td>
                        ' . date('Y') . ' Copymax Inc. since ' . date('Y') . '
                        </td>
                        </tr>
                        <tr>
                        <td>
                        ©' . date('Y') . ' Copymax Inc. All rights reserved.
                        </td>
                        </tr>
                        </table>

                        </td>
                        </tr>
                        </tbody>
                        </table>
                        </td>
                        </tr>
                        </tbody>
                   </table></body>';

                        $data['to'] = $this->input->post('reg_email');
                        //$data['to']='arindam.biswas@met-technologies.com';
                        //$data['to']='arindam.biswas@met-technologies.com,shubhadeep.chowdhury@met-technologies.com';
                        $data['name'] = 'Copymax Inc.';
                        $data['subject'] = 'Register with Copymax Inc.';
                        $data['message'] = $message;

                        $this->sendMail($data);

                        //-------------------------------------------------Auto Login-------------------------------------//
                        $remember = false;
                        if ($this->ion_auth->login($this->input->post('reg_email'), $this->input->post('reg_password'), $remember)) {
                            $user         = $this->ion_auth->user()->row();
                            $data['user'] = $user;
                            $this->session->set_flashdata('message', $this->ion_auth->messages());

                            //Cart Session Update
                            $this->insert_cart_db_common(); //sandy 14-05-2021

                            /*$cart_contents = $this->cart->contents();

                            if (!empty($cart_contents)) {

                                $this->cart->destroy();

                                $user_id = $this->ion_auth->get_user_id();
                                $arr     = $arr1 = $arr_session = array();
                                foreach ($cart_contents as $row) {

                                    $arr['user_id']           = $user_id;
                                    $arr['product_id']        = $row['product_id'];
                                    $arr['name']              = $row['name'];
                                    $arr['image']             = $row['image'];
                                    $arr['price']             = $row['price'];
                                    $arr['qty']               = $row['qty'];
                                    $arr['priniting_details'] = $row['priniting_details'];
                                    $arr['finishing_details'] = $row['finishing_details'];
                                    $arr['copies']            = $row['copies'];
                                    $arr['pages']             = $row['pages'];
                                    $arr['created_on']        = date('Y-m-d H:i:s');
                                    $arr['updated_on']        = date('Y-m-d H:i:s');
                                    $arr['status']            = 1;
									$arr['product_slug'] 	  = $row['product_slug']; //sandy 22-04-2021

                                    $this->db->insert('tbl_cart', $arr);

                                    $arr['id']                = $row['product_id'];
                                    
                                    $this->cart->insert($arr);
                                }

                                //echo "<pre>";print_r($this->cart->contents());die();
                            }*/
                        }
                        //--------------------------------------------------------End of auto login----------------------------------------------------------------//

                        $is_logged_in  = $this->ion_auth->logged_in();
                        $user_id   = $this->ion_auth->get_user_id();
                        $return_data = array('status' => true, 'message' => 'Thank You for registering with  us.', 'is_logged_in' => $is_logged_in, 'user_id' => $user_id);
                        /* end mail templete */
                    }
                } else {
                    $return_data = array('status' => false, 'message' => 'User already exists...');
                }
            } else {

                $return_data = array('status' => false, 'message' => 'Please Insert proper data...');
            }
        }
        if (isset($_POST['user_login_hid'])) {

            $this->form_validation->set_rules('username', 'Username|Email', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if ($this->form_validation->run() == true) {
                $remember = (bool) $this->input->post('remember');
                if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember)) {
                    $user         = $this->ion_auth->user()->row();
                    $data['user'] = $user;

                    $return_data = array('status' => true, 'message' => $this->ion_auth->messages());
                    //$this->session->set_flashdata('message', $this->ion_auth->messages());

                    //Cart Session Update
                    $this->insert_cart_db_common(); //sandy 14-05-2021
                    /*$cart_contents = $this->cart->contents();

                    if (!empty($cart_contents)) {

                        $this->cart->destroy();

                        $user_id = $this->ion_auth->get_user_id();
                        $arr     = $arr1 = $arr_session = array();
                        foreach ($cart_contents as $row) {

                            $arr['user_id']           = $user_id;
                            $arr['product_id']        = $row['product_id'];
                            $arr['name']              = $row['name'];
                            $arr['image']             = $row['image'];
                            $arr['price']             = $row['price'];
                            $arr['qty']               = $row['qty'];
                            $arr['priniting_details'] = $row['priniting_details'];
                            $arr['finishing_details'] = $row['finishing_details'];
                            $arr['copies']            = $row['copies'];
                            $arr['pages']             = $row['pages'];
                            $arr['created_on']        = date('Y-m-d H:i:s');
                            $arr['updated_on']        = date('Y-m-d H:i:s');
                            $arr['status']            = 1;
							$arr['product_slug'] 	  = $row['product_slug']; //sandy 22-04-2021

                            $this->db->insert('tbl_cart', $arr);

                            $arr['id']                = $row['product_id'];
                            $this->cart->insert($arr);
                        }

                        //echo "<pre>";print_r($this->cart->contents());die();
                    }*/
                    $is_logged_in  = $this->ion_auth->logged_in();
                    $user_id   = $this->ion_auth->get_user_id();
                    $return_data = array('status' => true, 'message' => 'Login Successfully', 'is_logged_in' => $is_logged_in, 'user_id' => $user_id);
                    // redirect(base_url('manage-addresses'));

                    // if (count($this->cart->contents()) > 0) {
                    //     redirect(base_url('checkout'));
                    // } else {
                    //     redirect(base_url('manage-addresses'));
                    // }
                    // echo "<pre>"; print_r($this->session->userdata()); die();
                } else {
                    // $this->session->set_flashdata('message', $this->ion_auth->errors());
                    $return_data = array('status' => false, 'message' => $this->ion_auth->errors());
                }
            } else {
                // $this->session->set_flashdata('message', $this->ion_auth->errors());
                $return_data = array('status' => false, 'message' => $this->ion_auth->errors());
            }
        }

        echo json_encode($return_data);
    }


    //sandy 14-05-2021 insert cart data in DB while login or register
    public function insert_cart_db_common()
    {
        $cart_contents = $this->cart->contents();
        //$this->cart->destroy();
        //print_r($cart_contents);die("common_method");
        if (!empty($cart_contents)) {

            //$user_id = 20;
            $user_id = $this->ion_auth->get_user_id();
            $arr = $arr1 = $arr_session = array();
            foreach ($cart_contents as $row) {
                //echo count($row);die("counter");
                /*$arr['user_id'] = $user_id;
				$arr['product_id'] = $row['product_id'];
				$arr['name'] = $row['name'];
				$arr['image'] = $row['image'];
				$arr['price'] = $row['price'];
				$arr['qty'] = $row['qty'];
				$arr['priniting_details'] = $row['priniting_details'];
				$arr['finishing_details'] = $row['finishing_details'];
				$arr['copies'] = $row['copies'];
				$arr['pages'] = $row['pages'];
				$arr['created_on'] = date('Y-m-d H:i:s');
				$arr['updated_on'] = date('Y-m-d H:i:s');
				$arr['status'] = 1;//*/

                //echo "Array <pre>";print_r($row);
                //unset($row['rowid']);
                $row['user_id'] = $user_id;
                $arr = array(
                    'user_id'            => $user_id,
                    'product_id'         => $row['product_id'],
                    'name'                 => $row['name'],
                    'image'             => $row['image'],
                    'price'             => $row['price'],
                    'price_page'         => $row['price_page'],
                    'priniting_details' => $row['priniting_details'],
                    'finishing_details' => $row['finishing_details'],
                    'paper_type_id'     => $row['paper_type_id'],
                    'dimensions'        => $row['dimensions'],
                    'copies'             => $row['copies'],
                    'pages'             => $row['pages'],
                    'qty'                 => $row['qty'],
                    'status'            => $row['status'],
                    'digital_proof'     => $row['digital_proof'],
                    'product_slug'        => $row['product_slug'],
                    'no_of_sides'        => $row['no_of_sides'],
                    'divider_sheets'    => $row['divider_sheets'],
                    'stapling'            => $row['stapling'],
                    'folding'            => $row['folding'],
                    'collation'            => $row['collation'],
                    'hole_punch'        => $row['hole_punch'],
                    'full_bleed'        => $row['full_bleed'],
                    'sides'                => $row['sides'],
                    'orientation'        => $row['orientation'],
                    'shipping_type'        => $row['shipping_type'],
                    'zip_code'            => $row['zip_code'],
                    'ups_shipping'        => $row['ups_shipping'],
                    'date'                => $row['date'],
                    'completion_date'    => $row['completion_date'],
                    'shipping_amount'    => $row['shipping_amount'],
                    'shipping_service_type'    => $row['shipping_service_type']
                );

                $arr['created_on'] = date('Y-m-d H:i:s');
                $arr['updated_on'] = date('Y-m-d H:i:s'); //*/

                $this->db->insert('tbl_cart', $arr);

                $this->cart->update($row);
                //echo "<pre>";print_r($row);
            }

            //print_r($this->cart->contents());die();
        }
    }


    public function checkout()
    {
        $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules   = $this->config->item('modules_locations');

        //$data = array();

        $data['input_data'] = $this->input->post();
        //echo "<pre>";print_r($data['input_data']);die();


        foreach ($this->cart->contents() as $cart_content) {

            $checkout_cart_array = array_merge($cart_content, $data['input_data']);
            $this->session->set_userdata($checkout_cart_array);
        }

        //echo "<pre>"; print_r($this->session->userdata()); die();
        //$this->cart->insert($cart_content);
        //echo "<pre>";print_r($this->session->userdata());die();



        if ($this->session->userdata('date')) {
            $data['date'] = $this->session->userdata('date');
        } elseif ($this->input->post('date') != "") {
            $data['date'] = $this->input->post('date');
        } else {
            $data['date'] = date('Y-m-d');
        }

        if ($this->session->userdata('shipping_amount')) {
            $data['shipping_amount'] = $this->session->userdata('shipping_amount');
        } elseif ($this->input->post('shipping_amount') != "") {
            $data['shipping_amount'] = $this->input->post('shipping_amount');
        } else {
            $data['shipping_amount'] = 0.00;
        }

        if ($this->session->userdata('shipping_service_type')) {
            $data['shipping_service_type'] = $this->session->userdata('shipping_service_type');
        } elseif ($this->input->post('shipping_service_type') != "") {
            $data['shipping_service_type'] = $this->input->post('shipping_service_type');
        } else {
            $data['shipping_service_type'] = 0.00;
        }


        if ($this->session->userdata('zip_code')) {
            $data['zip_code'] = $this->session->userdata('zip_code');
        } elseif ($this->input->post('zip_code') != "") {
            $data['zip_code'] = $this->input->post('zip_code');
        } else {
            $data['zip_code'] = 92121;
        }



        // //echo $data['zip_code'];die();
        // $cart_total = $this->cart->total();
        // //echo $this->input->post('shipping_type_val'); die();
        // $data['cart_content']   = $this->cart->contents();
        // //echo "<pre>"; print_r($data['cart_content']); die();
        // if($this->input->post('shipping_type') != "I'll pick up"){
        //     if($cart_total > 200){
        //         $data['shipping_amount'] = 0.00;
        //     }elseif($cart_total > 150 && $cart_total <= 200){
        //         $data['shipping_amount'] = 0.00;
        //     }else{
        //         if(!empty($data['cart_content'])){
        //             $temp = 0;
        //             foreach($data['cart_content'] as $cart_content){
        //                 //echo "asd"; die();
        //                 $ups_return = $this->get_ups_rate($data['zip_code'],$cart_total,$cart_content['paper_Type_id'],$cart_content['dimensions']);
        //                 //print_r($ups_return);
        //                 if ($ups_return['type'] == "success") {
        //                     $temp = $temp + $ups_return['data'];
        //                 }else{

        //                     $temp = $temp + 0.00;

        //                 }
        //             }
        //             //echo $temp;die;
        //             $data['shipping_amount'] = $temp;
        //         }
        //     }
        // }else{
        //     $data['shipping_amount'] = 0.00;
        // }

        //$this->session->set_userdata(array('shipping_amount'=>$data['shipping_amount']));
        //echo $this->session->set_userdata(); die();
        //die();
        //echo "<pre>"; print_r($this->session->userdata()); die();
        //$data['cart_sub_total'] = $this->cart->total();

        if ($this->session->userdata('coupon')) {
            $data['coupon'] = $this->session->userdata('coupon');
        } elseif ($this->input->post('coupon') == "") {
            $data['coupon'] = "0.00";
        } else {
            $data['coupon'] = $this->input->post('coupon');
        }

        if ($this->session->userdata('subtotal')) {
            $data['subtotal'] = $this->session->userdata('subtotal');
        } else {
            $data['subtotal'] = $this->input->post('subtotal');
        }

        if ($this->session->userdata('total_amount')) {
            $data['cart_sub_total'] = $this->session->userdata('total_amount');
        } else {
            $data['cart_sub_total'] = $this->input->post('total_amount');
        }

        if ($this->session->userdata('additional_charges_hid')) {
            $data['additional_charges'] = $this->session->userdata('additional_charges_hid');
        } else {
            $data['additional_charges'] = $this->input->post('additional_charges_hid');
        }

        if ($this->session->userdata('special_instruction_hid')) {
            $data['special_instruction'] = $this->session->userdata('special_instruction_hid');
        } else {
            $data['special_instruction'] = $this->input->post('special_instruction_hid');
        }


        if ($this->session->userdata('sales_tax')) {
            $data['sales_tax'] = $this->session->userdata('sales_tax');
        } else {
            $data['sales_tax'] = $this->input->post('sales_tax');
        }

        if ($this->ion_auth->logged_in()) {
            //echo $this->ion_auth->logged_in();print_r($this->ion_auth->user());die;
            $data['user_id'] = $this->ion_auth->get_user_id();
            $user            = $this->ion_auth->user()->row();
            $data['user']    = $user;
        } else {
            $data['user_id'] = "";
            $data['user']    = "";
        }


        // if (isset($_POST['user_register'])) {

        //     $users_arr = $this->home_model->getAllUsers();
        //     $status    = 1;
        //     $group_id  = 2;

        //     $this->form_validation->set_rules('reg_email', 'Email', 'trim|required');
        //     $this->form_validation->set_rules('reg_password', 'Password', 'trim|required');
        //     $this->form_validation->set_rules('reg_confirm_password', 'Confirm Password', 'trim|required|matches[reg_password]');

        //     $isExists = false;

        //     if ($this->form_validation->run() != FALSE) {
        //         foreach ($users_arr as $user) {
        //             //echo $users['email']."<br />";
        //             if ($user['email'] == $this->input->post('reg_email')) {
        //                 $isExists = true;
        //                 break;
        //             } else {
        //                 $isExists = false;
        //             }
        //         }

        //         //echo $isExists;
        //         if ($isExists != true) {

        //             //if($this->ion_auth->register('', $this->input->post('reg_password'), $this->input->post('reg_email'), array('username'=>$this->input->post('reg_username')), array('2')) != FALSE)
        //             if ($this->ion_auth->register('', $this->input->post('reg_password'), $this->input->post('reg_email'), array(), array(
        //                 '2'
        //             )) != FALSE) {

        //                 /* Mail Section Start */
        //                 $to      = $this->input->post('reg_email');
        //                 $subject = "Copymax Registration";
        //                 $message = "<html>
        //                             <head>
        //                             <title>Registration Email</title>
        //                             </head>
        //                             <body>
        //                             <p>Hi " . $this->input->post('reg_email') . ",</p>
        //                             <p>&nbsp;</p>
        //                             <p>Your Registration has been done successfully.<br/>Thank you for joining with Copymax.</p>
        //                             <p>&nbsp;</p>
        //                             <p>Best Regards,<br/>Copymax Team</p>
        //                             </body>
        //                             </html>";

        //                 $headers = "From: jayanta.saha@met-technologies.com" . "\r\n";
        //                 @mail($to, $subject, $message, $headers);
        //                 /* Mail Section End */

        //                 $this->session->set_flashdata('user_message', 'Registration done successfully.');

        //             }

        //         } else {
        //             $this->session->set_flashdata('user_message', 'User already exists...');
        //         }
        //     } else {
        //         $this->session->set_flashdata('user_message', 'Please Insert proper data...');
        //     }
        // }

        // if ($this->ion_auth->logged_in()) {

        //     // $this->form_validation->set_rules('username', 'Username|Email', 'trim|required');
        //     // $this->form_validation->set_rules('password', 'Password', 'trim|required');

        //     // if ($this->form_validation->run() == true) {
        //         // $remember = (bool) $this->input->post('remember');
        //         // if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember)) {
        //             // $user         = $this->ion_auth->user()->row();
        //             // $data['user'] = $user;
        //             // $this->session->set_flashdata('message', $this->ion_auth->messages());

        //             //Cart Session Update
        //             $cart_contents = $this->cart->contents();
        //             //print_r($cart_contents);die;
        //             if (!empty($cart_contents)) {

        //                 // echo "<pre>";
        //                 // print_r($cart_contents); echo "</pre>";
        //                 //print_r($this->input->post('post_data'));die;
        //                 // die();

        //                 //$this->cart->destroy();   arindam

        //                 $this->session->set_userdata('coupon', $this->input->post('post_data')['coupon']);
        //                 $this->session->set_userdata('subtotal', $this->input->post('post_data')['subtotal']);
        //                 $this->session->set_userdata('total_amount', $this->input->post('post_data')['total_amount']);
        //                 $this->session->set_userdata('additional_charges', $this->input->post('post_data')['additional_charges_hid']);
        //                 $this->session->set_userdata('sales_tax', $this->input->post('post_data')['sales_tax']);
        //                 $this->session->set_userdata('date', $this->input->post('post_data')['date']);
        //                 $this->session->set_userdata('shipping_amount', $this->input->post('post_data')['shipping_amount']);
        //                 $this->session->set_userdata('zip_code', $this->input->post('post_data')['zip_code']);
        //                 $this->session->set_userdata('paper_Type_id', $this->input->post('post_data')['paper_Type_id']);
        //                 $this->session->set_userdata('dimensions', $this->input->post('post_data')['dimensions']);
        //                 $this->session->set_userdata('digital_proof', $this->input->post('post_data')['digital_proof']);



        //                 $user_id = $this->ion_auth->get_user_id();
        //                 $arr     = $arr1 = $arr_session = array();
        //                 foreach ($cart_contents as $row) {

        //                     $arr['user_id']           = $user_id;
        //                     $arr['product_id']        = $row['product_id'];
        //                     $arr['name']              = $row['name'];
        //                     $arr['image']             = $row['image'];
        //                     $arr['price']             = $row['price'];
        //                     $arr['price_page']        = $row['price_page'];
        //                     $arr['qty']               = $row['qty'];
        //                     $arr['priniting_details'] = $row['priniting_details'];
        //                     $arr['finishing_details'] = $row['finishing_details'];
        //                     $arr['paper_Type_id']     = $row['paper_Type_id'];
        //                     $arr['dimensions']        = $row['dimensions'];
        //                     $arr['copies']            = $row['copies'];
        //                     $arr['pages']             = $row['pages'];
        //                     $arr['created_on']        = date('Y-m-d H:i:s');
        //                     $arr['updated_on']        = date('Y-m-d H:i:s');
        //                     $arr['status']            = 1;
        //                     $arr['digital_proof']     = $row['digital_proof'];


        //                     $this->db->insert('tbl_cart', $arr);

        //                     $arr['id']                = $row['product_id'];
        //                     $this->cart->insert($arr);
        //                 }
        //                 //echo "<pre>";print_r($this->cart->contents());die();
        //             }

        //             redirect(base_url('checkout'));
        //         } 
        //else {
        //     $this->session->set_flashdata('user_message', $this->ion_auth->errors());
        // }
        // } else {
        //     $this->session->set_flashdata('user_message', $this->ion_auth->errors());
        // }
        //}

        //$this->get_ups_rate();
        $data['delivery_time_val'] = $this->input->post('delivery_time');
        $data['current_date'] = $this->input->post('date');
        $data['zip_code'] = $this->input->post('zip_code');
        $data['shipping_type_val'] = $this->input->post('shipping_type');
        $data['cart_content'] = $this->cart->contents();
        $data['session_data'] = $this->session->userdata();

        // echo '<pre>';print_r($data['cart_content']);
        // echo '--------------------------------------';
        //echo '<pre>';print_r($data['session_data']);die;
        $user_id = $this->ion_auth->get_user_id();
        $data['address'] = $this->home_model->Show_Address_Book($user_id);

        $data['page_slug'] = end($this->uri->segments);

        $data['countries']  = $this->home_model->getAllDetails('countries');
        $data['page_title'] = "Login & Registration";
        $data['page']       = $this->config->item('bootsshop_template_dir_welcome') . "checkout";
        $data['module']     = 'welcome';

        $this->load->view($this->_container, $data);
    }

    //sandy 14-05-2021
    public function checkout_new()
    {

        $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');

        //$data = array();
        //die('checkout');
        $data['input_data'] = $this->input->post();
        //echo "<pre>";print_r($data['input_data']);die();


        foreach ($this->cart->contents() as $cart_content) {

            $checkout_cart_array = array_merge($cart_content, $data['input_data']);
            $this->session->set_userdata($checkout_cart_array);
        }
        if ($this->ion_auth->get_user_id() == 20) {
            //echo "<pre>"; print_r($this->cart->contents()); //die();
            //$this->cart->insert($cart_content);
            //echo "<pre>";print_r($this->session->all_userdata());die();
        }


        if ($this->input->post('shipping_amount') != "") {
            $data['shipping_amount'] = $this->input->post('shipping_amount');
        } else if ($this->session->userdata('shipping_amount')) {
            $data['shipping_amount'] = $this->session->userdata('shipping_amount');
        } else {
            $data['shipping_amount'] = 0.00;
        }


        if ($this->session->userdata('coupon')) {
            $data['coupon'] = $this->session->userdata('coupon');
        } elseif ($this->input->post('coupon') == "") {
            $data['coupon'] = "0.00";
        } else {
            $data['coupon'] = $this->input->post('coupon');
        }

        if ($this->session->userdata('subtotal')) {
            $data['subtotal'] = $this->session->userdata('subtotal');
        } else {
            $data['subtotal'] = $this->input->post('subtotal');
        }

        if ($this->session->userdata('total_amount')) {
            $data['cart_sub_total'] = $this->session->userdata('total_amount');
        } else {
            $data['cart_sub_total'] = $this->input->post('total_amount');
        }

        if ($this->session->userdata('additional_charges_hid')) {
            $data['additional_charges'] = $this->session->userdata('additional_charges_hid');
        } else {
            $data['additional_charges'] = $this->input->post('additional_charges_hid');
        }

        if ($this->session->userdata('special_instruction_hid')) {
            $data['special_instruction'] = $this->session->userdata('special_instruction_hid');
        } else {
            $data['special_instruction'] = $this->input->post('special_instruction_hid');
        }


        if ($this->session->userdata('sales_tax')) {
            $data['sales_tax'] = $this->session->userdata('sales_tax');
        } else {
            $data['sales_tax'] = $this->input->post('sales_tax');
        }

        if ($this->ion_auth->logged_in()) {
            //echo $this->ion_auth->logged_in();print_r($this->ion_auth->user());die;
            $data['user_id'] = $this->ion_auth->get_user_id();
            $user = $this->ion_auth->user()->row();
            $data['user'] = $user;
        } else {
            $data['user_id'] = "";
            $data['user'] = "";
        }

        $data['delivery_time_val'] = $this->input->post('delivery_time');
        $data['current_date'] = $this->input->post('date');
        $data['zip_code'] = $this->input->post('zip_code');
        $data['shipping_type_val'] = $this->input->post('shipping_type');
        $data['cart_content'] = $this->cart->contents();
        $data['session_data'] = $this->session->userdata();
        $data['is_free_shipping'] = false;

        foreach ($data['cart_content'] as $cart) {
            if ($cart['shipping_type'] == 'free') {
                $data['is_free_shipping'] = true;
                break;
            }
        }

        // echo '<pre>';print_r($data['cart_content']);
        // echo '--------------------------------------';
        //echo '<pre>';print_r($data['session_data']);die;
        $user_id = $this->ion_auth->get_user_id();
        $data['address'] = $this->home_model->Show_Address_Book($user_id);

        $data['page_slug'] = end($this->uri->segments);

        $data['countries'] = $this->home_model->getAllDetails('countries');
        $data['page_title'] = "Login & Registration";
        $data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "checkout_updated";

        $data['module'] = 'welcome';

        $this->load->view($this->_container, $data);
    }

    public function get_ups_rate($zipcode, $cart_total, $paper_Type_id, $dimensions)
    {
        //echo $zipcode; die();
        // echo $cart_total; echo "<br>";
        // echo $paper_Type_id; echo "<br>";
        //echo $dimensions; echo "<br>"; die();
        $accessKey = '4CE90AA1D1E82453';  //DD61CF56B88DDDFA //1D5F52F9E67DD1DA
        $userId = 'babanata';
        $password = '6180XeroX6180';
        $rate = new Ups\Rate(
            $accessKey,
            $userId,
            $password
        );
        $height = 0;
        $weight = 0;
        $volumn = $this->home_model->getProductVolumn($paper_Type_id, $dimensions);
        $dimension = explode('x', $dimensions);
        $width = $dimension[0];
        $length = $dimension[1];
        if (!empty($volumn)) {
            $height = $volumn['height'];
            $weight = $volumn['weight'];
        }

        try {
            $shipment = new \Ups\Entity\Shipment();

            $shipperAddress = $shipment->getShipper()->getAddress();
            $shipperAddress->setPostalCode('92081');

            $address = new \Ups\Entity\Address();
            $address->setPostalCode('92081');
            $shipFrom = new \Ups\Entity\ShipFrom();
            $shipFrom->setAddress($address);

            $shipment->setShipFrom($shipFrom);

            $shipTo = $shipment->getShipTo();
            $shipTo->setCompanyName('Test Ship To');
            $shipToAddress = $shipTo->getAddress();
            $shipToAddress->setPostalCode($zipcode);

            $package = new \Ups\Entity\Package();
            $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_PACKAGE);
            $package->getPackageWeight()->setWeight($weight);

            // if you need this (depends of the shipper country)
            $weightUnit = new \Ups\Entity\UnitOfMeasurement;
            $weightUnit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_LBS);
            $package->getPackageWeight()->setUnitOfMeasurement($weightUnit);

            $dimensions = new \Ups\Entity\Dimensions();
            $dimensions->setHeight($height);
            $dimensions->setWidth($width);
            $dimensions->setLength($length);

            $unit = new \Ups\Entity\UnitOfMeasurement;
            $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_IN);

            $dimensions->setUnitOfMeasurement($unit);
            $package->setDimensions($dimensions);

            $shipment->addPackage($package);
            $return = $rate->getRate($shipment);
            //echo " <pre> SUCCESS";
            //echo "<pre>"; print_r($return->RatedShipment[0]->TotalCharges->MonetaryValue); die();
            if (!empty($return)) {
                return array('type' => 'success', 'data' => $return->RatedShipment[0]->TotalCharges->MonetaryValue);
            } else {
                return array('type' => 'fail', 'data' => '0.00');
            }
        } catch (Exception $e) {
            // echo "<pre> ERROR";
            // print_r($e);
            // echo $e->message;
            // die();
            return array('type' => 'error', 'data' => '');
        }
    }

    public function place_order()
    {
        $images_full_path = array();
        //print_r($this->input->post());die;
        //print_r($this->ion_auth->user()->row());die;
        if ($this->ion_auth->get_user_id() == "") {
            redirect('cart');
        } else {
            $user_id = $this->ion_auth->get_user_id();
        }



        if ($this->input->post('place_order')) {

            $order_no_id = '';

            //$data['cart_content']         = $this->cart->contents();
            //$data['cart_sub_total']         = $this->cart->total();
            $billing_address = '';
            $shipping_address = '';

            $insert_address = array(
                'user_id' => $user_id,
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('contact_no'),
                'country' => $this->input->post('country'),
                'state' => $this->input->post('state'),
                'city' => $this->input->post('city'),
                'address' => $this->input->post('address'),
                'zip_code' => $this->input->post('zip_code'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            $billing_address_for_pay = $insert_address;

            $this->db->insert('tbl_billing_address', $insert_address);
            $billing_id = $this->db->insert_id();

            $billing_address = $this->input->post('address') . ',' . $this->input->post('city') . ',' . $this->input->post('state') . ',' . $this->input->post('country') . ',' . $this->input->post('zip_code');
            $shipping_address = $this->input->post('address') . ',' . $this->input->post('city') . ',' . $this->input->post('state') . ',' . $this->input->post('country') . ',' . $this->input->post('zip_code');


            if ($this->input->post('ship_to_different_address') == 1) {
                $insert_address = array(
                    'user_id' => $user_id,
                    'first_name' => $this->input->post('shipping_first_name'),
                    'last_name' => $this->input->post('shipping_last_name'),
                    'email' => $this->input->post('shipping_email'),
                    'phone' => $this->input->post('shipping_contact'),
                    'country' => $this->input->post('shipping_country'),
                    'state' => $this->input->post('shipping_state'),
                    'city' => $this->input->post('shipping_city'),
                    'address' => $this->input->post('shipping_address'),
                    'zip_code' => $this->input->post('shipping_zip_code'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $this->db->insert('tbl_shipping_address', $insert_address);



                $shipping_address = $this->input->post('shipping_address') . ',' . $this->input->post('shipping_city') . ',' . $this->input->post('shipping_state') . ',' . $this->input->post('shipping_country') . ',' . $this->input->post('shipping_zip_code');
            }


            //print_r($this->cart->contents());die;    
            foreach ($this->cart->contents() as $cart) {

                $insert_order = array(
                    'billing_id' => $billing_id,
                    'shipping_id' => '',
                    'user_id' => $user_id,
                    'product_id' => $cart['product_id'],
                    'printing_item' => $cart['priniting_details'],
                    'finishing_item' => $cart['finishing_details'],
                    'price' => $cart['price'],
                    'quantity' => $cart['qty'],
                    'images' => ($cart['image']) ? $cart['image'] : '',
                    'coupon_disc' => $this->session->userdata('coupon'),
                    'delivery_date' => $this->session->userdata('date'),
                    'delivery_time' => $this->session->userdata('delivery_time'),
                    'sales_tax' => $this->session->userdata('sales_tax'),
                    'additional_charge' => $this->session->userdata('additional_charges_hid'),
                    'special_instruction' => $this->session->userdata('special_instruction_hid'),
                    'shipping_amount' => $this->input->post('shipping_amount'),
                    'shipping_service_type' => $this->input->post('shipping_service_type'),
                    'total_price' => $this->session->userdata('total_amount'),
                    'shipping_type' => $this->session->userdata('shipping_type'),
                    'pages' => $cart['pages'],
                    'copies' => $cart['copies'],
                    'created_at' => date('Y-m-d H:i:s')
                );
            }


            //echo $insert_id; die();
            //$this->cart->destroy();

            if ($this->input->post('payment_method') == 'card') {
                $response = $this->authorized($billing_address_for_pay, $insert_order);
                if ($response != null) {
                    if ($response->getMessages()->getResultCode() == "Ok") {
                        $tresponse = $response->getTransactionResponse();
                        if ($tresponse != null && $tresponse->getMessages() != null) {
                            $data['payment_details']['transaction_id'] = $tresponse->getTransId();
                            $data['payment_details']['response_code'] = $tresponse->getResponseCode();
                            $data['payment_details']['message_code'] = $tresponse->getMessages()[0]->getCode();
                            $data['payment_details']['auth_code'] = $tresponse->getAuthCode();
                            $data['payment_details']['description'] = $tresponse->getMessages()[0]->getDescription();

                            $payment_details = array(
                                'payment_status' => '1',
                                'transaction_id' => $data['payment_details']['transaction_id'],
                                'response_code' => $data['payment_details']['response_code'],
                                'message_code' => $data['payment_details']['message_code'],
                                'auth_code' => $data['payment_details']['auth_code'],
                                'description' => $data['payment_details']['description'],
                                'payment_type' => 'card'
                            );
                            $this->session->set_flashdata('success_message', 'Your order has been placed Successfully');
                            $this->session->set_flashdata('payment_details', $payment_details);
                            // $this->cart->destroy();
                            //-------------------------------Order Place & Send Mail-----------------------------------//

                            $table_body = '';
                            //print_r($this->cart->contents());die;    
                            $subtotal = 0; //sandy 19-03-2021
                            foreach ($this->cart->contents() as $cart) {

                                $insert_order = array(
                                    'billing_id' => $billing_id,
                                    'shipping_id' => '',
                                    'user_id' => $user_id,
                                    'product_id' => $cart['product_id'],
                                    'printing_item' => $cart['priniting_details'],
                                    'finishing_item' => $cart['finishing_details'],
                                    'price' => $cart['price'],
                                    'quantity' => $cart['qty'],
                                    'payment_type' => 'Card',
                                    'transaction_id' => $tresponse->getTransId(),
                                    'images' => ($cart['image']) ? $cart['image'] : '',
                                    'coupon_disc' => $this->session->userdata('coupon'),
                                    'delivery_date' => $this->session->userdata('date'),
                                    'delivery_time' => $this->session->userdata('delivery_time'),
                                    'sales_tax' => $cart['subtotal'] * SALES_TAX_PER, //$this->session->userdata('sales_tax'),
                                    'additional_charge' => $this->session->userdata('additional_charges_hid'),
                                    'special_instruction' => $this->session->userdata('special_instruction_hid'),
                                    'shipping_amount' => $this->input->post('shipping_amount'),
                                    'shipping_service_type' => $this->input->post('shipping_service_type'),
                                    'total_price' => $this->session->userdata('total_amount'),
                                    'shipping_type' => $this->session->userdata('shipping_type'),
                                    'pages' => $cart['pages'],
                                    'copies' => $cart['copies'],
                                    'created_at' => date('Y-m-d H:i:s')
                                );

                                //sandy 18-03-21
                                $total_cart_items = count($this->cart->contents());
                                $insert_order['shipping_amount'] = (!empty($insert_order['shipping_amount'])) ? $insert_order['shipping_amount'] / $total_cart_items : 0;

                                $insert_order['additional_charge'] = (!empty($insert_order['additional_charge'])) ? $insert_order['additional_charge'] / $total_cart_items : 0;

                                $insert_order['total_price'] = $cart['subtotal'] + $insert_order['sales_tax'] + $insert_order['shipping_amount'] + $insert_order['additional_charge'];


                                $delivery_date_time = $this->session->userdata('date') . '  ' . $this->session->userdata('delivery_time');
                                //print_r($insert_order);die;
                                $this->db->insert('tbl_orders', $insert_order);
                                //echo $this->db->last_query();die;
                                $insert_id = $this->db->insert_id();
                                $order_no_id = '#ORD000' . $insert_id;
                                $this->db->where(array(
                                    'id' => $insert_id
                                ));
                                $update_order =  $this->db->update('tbl_orders', array('order_id' => $order_no_id));
                                $total_amount = $this->session->userdata('total_amount');
                                $qty = $cart['qty'];
                                $price = $cart['price'];


                                $product_details = $this->home_model->getRow('tbl_products', array('product_id' => $cart['product_id']));
                                $user_details = $this->home_model->getRow('users', array('id' => $user_id));


                                $printing_item = '<h3>' . $product_details['product_name'] . '</h3>';
                                $printing_item_string = explode(",", $cart['priniting_details']);

                                foreach ($printing_item_string as $printing) {

                                    $item_details = explode("||", $printing);
                                    $printing_item .= (isset($item_details[0]) ? $item_details[0] : '') . ' : ' . (isset($item_details[1]) ? $item_details[1] : '') . '<br>';
                                }

                                $finishing_item = '';
                                $finishing_item_string = explode(",", $cart['finishing_details']);

                                foreach ($finishing_item_string as $finishing) {

                                    $item_details = explode("||", $finishing);
                                    $finishing_item .= (isset($item_details[0]) ? $item_details[0] : '') . ' : ' . (isset($item_details[1]) ? $item_details[1] : '') . '<br>';
                                }




                                $no_of_pages = $cart['pages'];
                                $no_of_copies = $cart['copies'];
                                //$subtotal = $this->session->userdata('subtotal');
                                $item_subtotal = $cart['subtotal']; //sandy 19-03-2021
                                $coupon = ($this->session->userdata('coupon')) ? $this->session->userdata('coupon') : 0;
                                $sales_tax = $this->session->userdata('sales_tax');
                                $total_amount = $this->session->userdata('total_amount');
                                $additional_charges_hid = $this->session->userdata('additional_charges_hid');
                                $shipping_amount = $this->input->post('shipping_amount');
                                $shipping_service_type = $this->input->post('shipping_service_type');
                                $shipping_type = $this->session->userdata('shipping_type');
                                $delivery_time = $this->session->userdata('delivery_time');
                                $special_instruction = $this->session->userdata('special_instruction_hid');



                                $table_body .= '<tr>
                                                <td class="desc">' . $printing_item . '</td>
                                                <td class="desc">' . $finishing_item . '</td>
                                                <td class="qty" style="text-align: right;">' . $no_of_pages . '</td>
                                                <td class="unit" style="text-align: right;">' . $no_of_copies . '</td>
                                                <td class="total" style="text-align: right;">' . $item_subtotal . '</td>
                                            </tr>'; //sandy 19-03-2021/ 31-03-2021


                                /*
							if (isset($cart['image'])) {
    
                                $cart_images = explode("||", $cart['image']);
                                foreach ($cart_images as $images) {
                                    array_push($images_full_path, $images);
                                }
                            }*/

                                //sandy 27-03-21 start
                                if (isset($cart['image'])) {

                                    $cart_images = explode("||", $cart['image']);
                                    //print_r($cart_images);
                                    mkdir('uploads/order_uploads/' . $order_no_id, 0755, true);

                                    foreach ($cart_images as $images) {
                                        array_push($images_full_path, $images);
                                        $dest_path = 'uploads/order_uploads/' . $order_no_id . '/';

                                        $file = safe_str_replace('#', '', $images);
                                        copy('uploads/files/' . $file, $dest_path . $file);
                                    }
                                }
                                //sandy 27-03-21 end

                                $subtotal += $item_subtotal; //sandy 19-03-2021
                            }

                            $total_amount = $subtotal + $sales_tax + $shipping_amount + $additional_charges_hid; //sandy 19-03-2021
                            $table_footer = '
								<tr>
								   <td colspan="3"></td>
									<td class="unit" style="text-align: right;"><strong>Subtotal : </strong></td>
									<td class="total" style="text-align: right;">' . number_format($subtotal, 2) . '</td>
								</tr>
								<tr>
									<td colspan="3"></td>
									<td class="unit" style="text-align: right;"><strong>Sales Tax : </strong></td>
									<td class="total" style="text-align: right;">' . number_format($sales_tax, 2) . '</td>
								</tr>
								<tr>
									<td colspan="3"></td>
									<td class="unit" style="text-align: right;"><strong>Additional Charges : </strong></td>
									<td class="total" style="text-align: right;">' . number_format($additional_charges_hid, 2) . '</td>
								</tr>
								<tr>
									<td colspan="3"></td>
									<td class="unit" style="text-align: right;"><strong>Shipping Amount : </strong></td>
									<td class="total" style="text-align: right;">' . number_format($shipping_amount, 2) . '</td>
								</tr>
								<tr>
									<td colspan="3"></td>
									<td class="unit" style="text-align: right;"><strong> Coupon Discount : </strong></td>
									<td class="total" style="text-align: right;">' . number_format($coupon, 2) . '</td>
								</tr>
								<tr>
									<td colspan="3"></td>
									<td class="unit" style="text-align: right;"><strong>GRAND TOTAL : </strong></td>
									<td class="total" style="text-align: right;">' . number_format($total_amount, 2) . '</td>
								</tr> ';

                            // echo $printing_item;
                            // echo $finishing_item;
                            // echo $table_body;
                            // echo $table_footer;die;

                            $table_body .= $table_footer;

                            $mail_temp = file_get_contents('./global/mail/invoice_template.html');

                            $mail_temp = safe_str_replace("{LOGO}", base_url('./assets/frontend/images/logo.png'), $mail_temp);
                            $mail_temp = safe_str_replace("{COMPANY_NAME}", "Copymax Inc.", $mail_temp);
                            $mail_temp = safe_str_replace("{COMPANY_ADDRESS}", '802 North twin oaks valley road, STE 108, San Marcos, CA 92069', $mail_temp);
                            $mail_temp = safe_str_replace("{COMPANY_PHONE}", '1-844-Copymax (2679629)', $mail_temp);
                            $mail_temp = safe_str_replace("{COMPANY_EMAIL}", 'info@copymaxinc.com', $mail_temp);
                            $mail_temp = safe_str_replace("{COMPANY_EMAIL_NEW}", 'copymaxinc@gmail.com', $mail_temp);

                            $mail_temp = safe_str_replace("{CUSTOMER_NAME}", $this->input->post('first_name') . ' ' . $this->input->post('last_name'), $mail_temp);
                            $mail_temp = safe_str_replace("{CUSTOMER_MOBILE}", $this->input->post('contact_no'), $mail_temp);
                            $mail_temp = safe_str_replace("{CUSTOMER_EMAIL}", ($user_details['email']) ? $user_details['email'] : '', $mail_temp);

                            $mail_temp = safe_str_replace("{INVOICE_NUMBER}", $order_no_id, $mail_temp);



                            $mail_temp = safe_str_replace("{SHIPPING_ADDRESS}", $shipping_address, $mail_temp);
                            $mail_temp = safe_str_replace("{BILLING_ADDRESS}", $billing_address, $mail_temp);
                            $mail_temp = safe_str_replace("{SPECIAL_INSTRUCTION}", $special_instruction, $mail_temp);
                            $mail_temp = safe_str_replace("{DELIVERY_DATE_TIME}", $delivery_date_time, $mail_temp);
                            $mail_temp = safe_str_replace("{TABLE_BODY}", $table_body, $mail_temp);
                            $mail_temp = safe_str_replace("{SHIPPING_TYPE}", $shipping_type, $mail_temp);
                            $mail_temp = safe_str_replace("{SHIPPING_SERVICE_TYPE}", $shipping_service_type, $mail_temp);




                            $user_details = array();
                            $user_details = $this->ion_auth->user()->row();
                            //print_r($user_details);die;
                            $customer_email = isset($user_details->email) ? $user_details->email : '';
                            //$data['to'] = 'copymaxinc@gmail.com,'.($customer_email)?','.$customer_email :'';
                            $data['to'] = $customer_email;
                            //$data['to']='amitava.rc25@gmail.com';
                            $data['name'] = 'Copymax Inc.';
                            $data['subject'] = 'Copymax Inc. - Order Placed';
                            $data['message'] = $mail_temp;
                            $data['from'] = EMAIL_SMTP_FROM_EMAIL;

                            $this->sendMailContactUs($data, $images_full_path, $invoice_path = null);
                            $data['to'] = "copymaxinc@gmail.com";
                            //$data['to'] = "jeanne.west3426@gmail.com"; //sandy 19-03-2021

                            $this->sendMailContactUs($data, $images_full_path, $invoice_path = null);

                            /*if (!empty($images_full_path)) {
								if(!file_exists('uploads/order_uploads/'. $order_no_id)) {										
									@mkdir('uploads/order_uploads/'. $order_no_id,0755, true);
								}
								$dest_path = 'uploads/order_uploads/' . $order_no_id . '/';
								foreach ($images_full_path as $file) {
									$file = safe_str_replace('#', '', $file);
									if(is_file('uploads/files/' . $file)) {
										@copy('uploads/files/' . $file, $dest_path . $file);
									}
								} 
							}*/

                            //echo 'success';die;	

                            $array_items = array(
                                'id' => '',
                                'product_id' => '',
                                'name' => '',
                                'shipping_type' => '',
                                'image' => '',
                                'price' => '',
                                'price_page' => '',
                                'priniting_details' => '',
                                'finishing_details' => '',
                                'paper_type_id' => '',
                                'dimensions' => '',
                                'copies' => '',
                                'pages' => '',
                                'qty' => '',
                                'status' => '',
                                'digital_proof' => '',
                                'rowid' => '',
                                'subtotal' => '',
                                'date' => '',
                                'shipping_amount' => '',
                                'shipping_service_type' => '',
                                'zip_code' => '',
                                'coupon' => '',
                                'sales_tax' => '',
                                'total_amount' => '',
                                'additional_charges_hid' => '',
                                'special_instruction_hid' => '',
                                'shipping_type' => '',
                                'delivery_time' => ''
                            );
                            $this->session->unset_userdata($array_items);
                            $this->cart->destroy();


                            //--------------------------------------END ------------------------------------------------//


                        } else {
                            if ($tresponse->getErrors() != null) {
                                $data['payment_details']['error_code'] = $tresponse->getErrors()[0]->getErrorCode();
                                $data['payment_details']['error_message'] = $tresponse->getErrors()[0]->getErrorText();
                            }
                            $payment_details = array(
                                'payment_status' => '2',
                                'error_code' => $data['payment_details']['error_code'],
                                'error_message' => $data['payment_details']['error_message'],
                                'payment_type' => 'card'
                            );
                            $this->session->set_flashdata('payment_details', $payment_details);
                            $this->session->set_flashdata('error_message', 'Payment failed.');
                            $this->checkout();
                            //redirect(base_url("checkout"));
                        }
                    } else {
                        $tresponse = $response->getTransactionResponse();
                        if ($tresponse != null && $tresponse->getErrors() != null) {
                            $data['payment_details']['error_code'] = $tresponse->getErrors()[0]->getErrorCode();
                            $data['payment_details']['error_message'] = $tresponse->getErrors()[0]->getErrorText();
                        } else {
                            $data['payment_details']['error_code'] = $response->getMessages()->getMessage()[0]->getCode();
                            $data['payment_details']['error_message'] = $response->getMessages()->getMessage()[0]->getText();
                        }
                        $payment_details = array(
                            'payment_status' => '2',
                            'error_code' => $data['payment_details']['error_code'],
                            'error_message' => $data['payment_details']['error_message'],
                            'payment_type' => 'card'
                        );
                        $this->session->set_flashdata('error_message', 'Payment failed.');
                        $this->session->set_flashdata('payment_details', $payment_details);

                        $this->checkout();
                        //redirect(base_url("checkout"));
                    }
                } else {
                    $data['payment_details']['error_message'] = "No response returned";
                    $payment_details = array(
                        'payment_status' => '2',
                        'error_message' => $data['payment_details']['error_message']
                    );
                    $this->session->set_flashdata('error_message', 'Payment failed.');
                    $this->session->set_flashdata('payment_details', $payment_details);
                    $this->checkout();
                    //redirect(base_url("checkout"));
                }
            } else {
                //--------------------------------------------Temporary Cash On Delivery-----------------------------------------------------//
                // $this->cart->destroy();
                //-------------------------------Order Place & Send Mail-----------------------------------//

                $table_body = '';
                //print_r($this->cart->contents());die;    
                $subtotal = 0; //sandy 19-03-2021
                foreach ($this->cart->contents() as $cart) {

                    $insert_order = array(
                        'billing_id' => $billing_id,
                        'shipping_id' => '',
                        'user_id' => $user_id,
                        'product_id' => $cart['product_id'],
                        'printing_item' => $cart['priniting_details'],
                        'finishing_item' => $cart['finishing_details'],
                        'price' => $cart['price'],
                        'quantity' => $cart['qty'],
                        'payment_type' => 'cash',
                        'images' => ($cart['image']) ? $cart['image'] : '',
                        'coupon_disc' => $this->session->userdata('coupon'),
                        'delivery_date' => $this->session->userdata('date'),
                        'delivery_time' => $this->session->userdata('delivery_time'),
                        'sales_tax' => $cart['subtotal'] * SALES_TAX_PER, //sandy 18-03-2021 
                        //$this->session->userdata('sales_tax'),
                        'additional_charge' => $this->session->userdata('additional_charges_hid'),
                        'special_instruction' => $this->session->userdata('special_instruction_hid'),
                        'shipping_amount' => $this->input->post('shipping_amount'),
                        'shipping_service_type' => $this->input->post('shipping_service_type'),
                        'total_price' => $this->session->userdata('total_amount'),
                        'shipping_type' => $this->session->userdata('shipping_type'),
                        'pages' => $cart['pages'],
                        'copies' => $cart['copies'],
                        'created_at' => date('Y-m-d H:i:s')
                    );

                    //sandy 18-03-2021
                    $total_cart_items = count($this->cart->contents());
                    $insert_order['shipping_amount'] = (!empty($insert_order['shipping_amount'])) ? $insert_order['shipping_amount'] / $total_cart_items : 0;

                    $insert_order['additional_charge'] = (!empty($insert_order['additional_charge'])) ? $insert_order['additional_charge'] / $total_cart_items : 0;

                    $insert_order['total_price'] = $cart['subtotal'] + $insert_order['sales_tax'] + $insert_order['shipping_amount'] + $insert_order['additional_charge'];

                    $delivery_date_time = $this->session->userdata('date') . '  ' . $this->session->userdata('delivery_time');
                    //print_r($insert_order);die;
                    $this->db->insert('tbl_orders', $insert_order);
                    //echo $this->db->last_query();die;
                    $insert_id = $this->db->insert_id();
                    $order_no_id = '#ORD000' . $insert_id;
                    $this->db->where(array(
                        'id' => $insert_id
                    ));
                    $update_order =  $this->db->update('tbl_orders', array('order_id' => $order_no_id));
                    $total_amount = $this->session->userdata('total_amount');
                    $qty = $cart['qty'];
                    $price = $cart['price'];


                    $product_details = $this->home_model->getRow('tbl_products', array('product_id' => $cart['product_id']));
                    $user_details = $this->home_model->getRow('users', array('id' => $user_id));


                    $printing_item = '<h3>' . $product_details['product_name'] . '</h3>';
                    $printing_item_string = explode(",", $cart['priniting_details']);

                    foreach ($printing_item_string as $printing) {

                        $item_details = explode("||", $printing);
                        $printing_item .= (isset($item_details[0]) ? $item_details[0] : '') . ' : ' . (isset($item_details[1]) ? $item_details[1] : '') . '<br>';
                    }

                    $finishing_item = '';
                    $finishing_item_string = explode(",", $cart['finishing_details']);

                    foreach ($finishing_item_string as $finishing) {

                        $item_details = explode("||", $finishing);
                        $finishing_item .= (isset($item_details[0]) ? $item_details[0] : '') . ' : ' . (isset($item_details[1]) ? $item_details[1] : '') . '<br>';
                    }




                    $no_of_pages = $cart['pages'];
                    $no_of_copies = $cart['copies'];
                    //$subtotal = $this->session->userdata('subtotal');
                    $item_subtotal = $cart['subtotal']; //sandy 19-03-2021
                    $coupon = ($this->session->userdata('coupon')) ? $this->session->userdata('coupon') : 0;
                    $sales_tax = $this->session->userdata('sales_tax');
                    $total_amount = $this->session->userdata('total_amount');
                    $additional_charges_hid = $this->session->userdata('additional_charges_hid');
                    $shipping_amount = $this->input->post('shipping_amount');
                    $shipping_service_type = $this->input->post('shipping_service_type');
                    $shipping_type = $this->session->userdata('shipping_type');
                    $delivery_time = $this->session->userdata('delivery_time');
                    $special_instruction = $this->session->userdata('special_instruction_hid');



                    $table_body .= '<tr>
                                    <td class="desc">' . $printing_item . '</td>
                                    <td class="desc">' . $finishing_item . '</td>
                                    <td class="qty" style="text-align: right;">' . $no_of_pages . '</td>
                                    <td class="unit" style="text-align: right;">' . $no_of_copies . '</td>
                                    <td class="total" style="text-align: right;">' . $item_subtotal . '</td>
                                </tr>'; //sandy 19-03-2021 / 31-03-2021


                    /** 
                        if (isset($cart['image'])) {
                            $cart_images = explode("||", $cart['image']);
                            foreach ($cart_images as $images) {
                                array_push($images_full_path, $images);
                            }
                        }   
                    */

                    //sandy 27-03-21 start
                    if (isset($cart['image'])) {

                        $cart_images = explode("||", $cart['image']);
                        //print_r($cart_images);
                        mkdir('uploads/order_uploads/' . $order_no_id, 0755, true);

                        foreach ($cart_images as $images) {
                            array_push($images_full_path, $images);
                            $dest_path = 'uploads/order_uploads/' . $order_no_id . '/';

                            $file = safe_str_replace('#', '', $images);
                            copy('uploads/files/' . $file, $dest_path . $file);
                        }
                    }

                    //sandy 27-03-21 end
                    $subtotal += $item_subtotal; //sandy 19-03-2021
                }

                $total_amount = $subtotal + $sales_tax + $shipping_amount + $additional_charges_hid - $coupon; //sandy 19-03-2021

                $table_footer = '
				<tr>
				   <td colspan="3"></td>
					<td class="unit" style="text-align: right;"><strong>Subtotal : </strong></td>
					<td class="total" style="text-align: right;">' . number_format($subtotal, 2) . '</td>
				</tr>
				<tr>
				<td colspan="3"></td>
					<td class="unit" style="text-align: right;"><strong>Sales Tax : </strong></td>
					<td class="total" style="text-align: right;">' . number_format($sales_tax, 2) . '</td>
				</tr>
				<tr>
				<td colspan="3"></td>
					<td class="unit" style="text-align: right;"><strong>Additional Charges : </strong></td>
					<td class="total" style="text-align: right;">' . number_format($additional_charges_hid, 2) . '</td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td class="unit" style="text-align: right;"><strong>Shipping Amount : </strong></td>
					<td class="total" style="text-align: right;">' . number_format($shipping_amount, 2) . '</td>
				</tr>
				<tr>
				<td colspan="3"></td>
					<td class="unit" style="text-align: right;"><strong> Coupon Discount : </strong></td>
					<td class="total" style="text-align: right;">' . number_format($coupon, 2) . '</td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td class="unit" style="text-align: right;"><strong>GRAND TOTAL : </strong></td>
					<td class="total" style="text-align: right;">' . number_format($total_amount, 2) . '</td>
				</tr> ';

                // echo $printing_item;
                // echo $finishing_item;
                // echo $table_body;
                // echo $table_footer;die;

                $table_body .= $table_footer;

                $mail_temp = file_get_contents('./global/mail/invoice_template.html');

                $mail_temp = safe_str_replace("{LOGO}", base_url('./assets/frontend/images/logo.png'), $mail_temp);
                $mail_temp = safe_str_replace("{COMPANY_NAME}", "Copymax Inc.", $mail_temp);
                $mail_temp = safe_str_replace("{COMPANY_ADDRESS}", '802 North twin oaks valley road, STE 108, San Marcos, CA 92069', $mail_temp);
                $mail_temp = safe_str_replace("{COMPANY_PHONE}", '1-844-Copymax (2679629)', $mail_temp);
                $mail_temp = safe_str_replace("{COMPANY_EMAIL}", 'info@copymaxinc.com', $mail_temp);
                $mail_temp = safe_str_replace("{COMPANY_EMAIL_NEW}", 'copymaxinc@gmail.com', $mail_temp);

                $mail_temp = safe_str_replace("{CUSTOMER_NAME}", $this->input->post('first_name') . ' ' . $this->input->post('last_name'), $mail_temp);
                $mail_temp = safe_str_replace("{CUSTOMER_MOBILE}", $this->input->post('contact_no'), $mail_temp);
                $mail_temp = safe_str_replace("{CUSTOMER_EMAIL}", ($user_details['email']) ? $user_details['email'] : '', $mail_temp);

                $mail_temp = safe_str_replace("{INVOICE_NUMBER}", $order_no_id, $mail_temp);



                $mail_temp = safe_str_replace("{SHIPPING_ADDRESS}", $shipping_address, $mail_temp);
                $mail_temp = safe_str_replace("{BILLING_ADDRESS}", $billing_address, $mail_temp);
                $mail_temp = safe_str_replace("{SPECIAL_INSTRUCTION}", $special_instruction, $mail_temp);
                $mail_temp = safe_str_replace("{DELIVERY_DATE_TIME}", $delivery_date_time, $mail_temp);
                $mail_temp = safe_str_replace("{TABLE_BODY}", $table_body, $mail_temp);
                $mail_temp = safe_str_replace("{SHIPPING_TYPE}", $shipping_type, $mail_temp);
                $mail_temp = safe_str_replace("{SHIPPING_SERVICE_TYPE}", $shipping_service_type, $mail_temp);




                $user_details = array();
                $user_details = $this->ion_auth->user()->row();
                //print_r($user_details);die;
                $customer_email = isset($user_details->email) ? ',' . $user_details->email : '';
                $data['to'] = $customer_email;
                //$data['to']='amitava.rc25@gmail.com';
                $data['name'] = 'Copymax Inc.';
                $data['subject'] = 'Copymax Inc. - Order Placed';
                $data['message'] = $mail_temp;
                $data['from'] = EMAIL_SMTP_FROM_EMAIL;
                //echo $mail_temp;die;

                $this->sendMailContactUs($data, $images_full_path, $invoice_path = null);
                $data['to'] = "copymaxinc@gmail.com";
                //$data['to'] = "jeanne.west3426@gmail.com"; //sandy 19-03-2021
                /* cash mail */
                $this->sendMailContactUs($data, $images_full_path, $invoice_path = null);

                /*if (!empty($images_full_path)) {
					 if(!file_exists('uploads/order_uploads/'. $order_no_id)) {
						@mkdir('uploads/order_uploads/'. $order_no_id, 0755, true);
					 }
					 $dest_path = 'uploads/order_uploads/' . $order_no_id . '/';
				foreach ($images_full_path as $file) {
						$file = safe_str_replace('#', '', $file);
						if(is_file('uploads/files/' . $file)) {
							@copy('uploads/files/' . $file, $dest_path . $file);
						}
					} 
				} */ //sandy 27-03-21
                //echo 'success';die;	

                $array_items = array(
                    'id' => '',
                    'product_id' => '',
                    'name' => '',
                    'shipping_type' => '',
                    'image' => '',
                    'price' => '',
                    'price_page' => '',
                    'priniting_details' => '',
                    'finishing_details' => '',
                    'paper_type_id' => '',
                    'dimensions' => '',
                    'copies' => '',
                    'pages' => '',
                    'qty' => '',
                    'status' => '',
                    'digital_proof' => '',
                    'rowid' => '',
                    'subtotal' => '',
                    'date' => '',
                    'shipping_amount' => '',
                    'shipping_service_type' => '',
                    'zip_code' => '',
                    'coupon' => '',
                    'sales_tax' => '',
                    'total_amount' => '',
                    'additional_charges_hid' => '',
                    'special_instruction_hid' => '',
                    'shipping_type' => '',
                    'delivery_time' => ''
                );
                $this->session->unset_userdata($array_items);
                $this->cart->destroy();


                //--------------------------------------END ------------------------------------------------//
                $data['payment_details']['transaction_id'] = 'Cash On Delivery';
                $data['payment_details']['response_code'] = '';
                $data['payment_details']['message_code'] = '';
                $data['payment_details']['auth_code'] = '';
                $data['payment_details']['description'] = '';
                $data['payment_details']['payment_status'] = 1;


                $payment_details = array(
                    'payment_status' => '1',
                    'transaction_id' => 'Cash On Delivery',
                    'response_code' => '',
                    'message_code' => '',
                    'auth_code' => '',
                    'description' => 'Your order has been placed Successfully',
                    'payment_type' => 'cash'
                );
                $this->session->set_flashdata('success_message', 'Your order has been placed Successfully');
                $this->session->set_flashdata('payment_details', $payment_details);
            }

            
            //--------------------------------------CASH ON DELIVERY END ------------------------------------------------//


            $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
            $this->_modules   = $this->config->item('modules_locations');


            if ($payment_details['payment_status'] == 1) {
                //$data               = array();
                $data['ref']        = $order_no_id;
                //$data['page_title'] = "Order Success";
                $data['module']     = 'welcome';
                $data['page']       = $this->config->item('bootsshop_template_dir_welcome') . "payment_response";
                $this->load->view($this->_container, $data);
            }
        }
    }


    //sandy 15-05-2021
    public function place_order_new()
    {

        $images_full_path = array();
        //print_r($this->input->post());die;
        //print_r($this->ion_auth->user()->row());die;
        if ($this->ion_auth->get_user_id() == "") {
            redirect('cart');
        } else {
            $user_id = $this->ion_auth->get_user_id();
        }

        //echo "<pre>";print_r($this->input->post());//die;
        if ($this->input->post('place_order')) {

            $order_no_id = '';

            //$data['cart_content']         = $this->cart->contents();
            //$data['cart_sub_total']         = $this->cart->total();
            $billing_address = '';
            $shipping_address = '';

            $insert_address = array(
                'user_id' => $user_id,
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('contact_no'),
                'country' => $this->input->post('country'),
                'state' => $this->input->post('state'),
                'city' => $this->input->post('city'),
                'address' => $this->input->post('address'),
                'zip_code' => $this->input->post('zip_code'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            $billing_address_for_pay = $insert_address;

            $this->db->insert('tbl_billing_address', $insert_address);
            $data['billing_id'] = $this->db->insert_id();
            $data['shipping_id'] = 0;
            $data['user_id'] = $user_id;
            $data['billing_address'] = $this->input->post('address') . ',' . $this->input->post('city') . ',' . $this->input->post('state') . ',' . $this->input->post('country') . ',' . $this->input->post('zip_code');

            $data['shipping_address'] = $this->input->post('address') . ',' . $this->input->post('city') . ',' . $this->input->post('state') . ',' . $this->input->post('country') . ',' . $this->input->post('zip_code');


            if ($this->input->post('ship_to_different_address') == 1) {
                $insert_address = array(
                    'user_id' => $user_id,
                    'first_name' => $this->input->post('shipping_first_name'),
                    'last_name' => $this->input->post('shipping_last_name'),
                    'email' => $this->input->post('shipping_email'),
                    'phone' => $this->input->post('shipping_contact'),
                    'country' => $this->input->post('shipping_country'),
                    'state' => $this->input->post('shipping_state'),
                    'city' => $this->input->post('shipping_city'),
                    'address' => $this->input->post('shipping_address'),
                    'zip_code' => $this->input->post('shipping_zip_code'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $this->db->insert('tbl_shipping_address', $insert_address);
                $data['shipping_id'] = $this->db->insert_id();

                $data['shipping_address'] = $this->input->post('shipping_address') . ',' . $this->input->post('shipping_city') . ',' . $this->input->post('shipping_state') . ',' . $this->input->post('shipping_country') . ',' . $this->input->post('shipping_zip_code');
            }

            if ($this->input->post('payment_method') == 'card') {
             
                //$response = $this->authorized($billing_address_for_pay, $insert_order);
                $response = $this->authorized($billing_address_for_pay, $data);
                if ($response != null) {
                    if ($response->getMessages()->getResultCode() == "Ok") {
                        $tresponse = $response->getTransactionResponse();
                        if ($tresponse != null && $tresponse->getMessages() != null) {
                            $data['payment_details']['transaction_id'] = $tresponse->getTransId();
                            $data['payment_details']['response_code'] = $tresponse->getResponseCode();
                            $data['payment_details']['message_code'] = $tresponse->getMessages()[0]->getCode();
                            $data['payment_details']['auth_code'] = $tresponse->getAuthCode();
                            $data['payment_details']['description'] = $tresponse->getMessages()[0]->getDescription();

                            $payment_details = array(
                                'payment_status' => '1',
                                'transaction_id' => $data['payment_details']['transaction_id'],
                                'response_code' => $data['payment_details']['response_code'],
                                'message_code' => $data['payment_details']['message_code'],
                                'auth_code' => $data['payment_details']['auth_code'],
                                'description' => $data['payment_details']['description'],
                                'payment_type' => 'card'
                            );
                            $this->session->set_flashdata('success_message', 'Your order has been placed Successfully');
                            $this->session->set_flashdata('payment_details', $payment_details);
                            // $this->cart->destroy();
                            //-------------------------------Order Place & Send Mail-----------------------------------//
                            //sandy 10-04-2021
                            $data['payment_type'] = 'card';
                            $order_no_id = $this->store_cart_data($data, true);
 
                            //--------------------------------------END ------------------------------------------------//
                        } else {
                            if ($tresponse->getErrors() != null) {
                                $data['payment_details']['error_code'] = $tresponse->getErrors()[0]->getErrorCode();
                                $data['payment_details']['error_message'] = $tresponse->getErrors()[0]->getErrorText();
                            }
                            $payment_details = array(
                                'payment_status' => '2',
                                'error_code' => $data['payment_details']['error_code'],
                                'error_message' => $data['payment_details']['error_message'],
                                'payment_type' => 'card'
                            );
                            $this->session->set_flashdata('payment_details', $payment_details);
                            $this->session->set_flashdata('error_message', 'Payment failed.');
                            $this->checkout();
                            //redirect(base_url("checkout"));
                          
                        }
                    } else {
                        $tresponse = $response->getTransactionResponse();
                        if ($tresponse != null && $tresponse->getErrors() != null) {
                            $data['payment_details']['error_code'] = $tresponse->getErrors()[0]->getErrorCode();
                            $data['payment_details']['error_message'] = $tresponse->getErrors()[0]->getErrorText();
                        } else {
                            $data['payment_details']['error_code'] = $response->getMessages()->getMessage()[0]->getCode();
                            $data['payment_details']['error_message'] = $response->getMessages()->getMessage()[0]->getText();
                        }
                        $payment_details = array(
                            'payment_status' => '2',
                            'error_code' => $data['payment_details']['error_code'],
                            'error_message' => $data['payment_details']['error_message'],
                            'payment_type' => 'card'
                        );
                        $this->session->set_flashdata('error_message', 'Payment failed.');
                        $this->session->set_flashdata('payment_details', $payment_details);

                        $this->checkout();
                        //redirect(base_url("checkout"));
                    }
                } else {
                    $data['payment_details']['error_message'] = "No response returned";
                    $payment_details = array(
                        'payment_status' => '2',
                        'error_message' => $data['payment_details']['error_message']
                    );
                    $this->session->set_flashdata('error_message', 'Payment failed.');
                    $this->session->set_flashdata('payment_details', $payment_details);
                    $this->checkout();
                    //redirect(base_url("checkout"));
                }
            } else {
                //--------------------------------------------Temporary Cash On Delivery-----------------------------------------------------//cod
                //sandy 10-4-2021
                // $data['payment_type'] = ($this->input->post('payment_method') == 'cod') ? 'cash' : 'No Payment';
                   $data['payment_type'] = ($this->input->post('payment_method') == 'cod') ? 'cash' : 'No Payment';
                $order_no_id = $this->store_cart_data($data, true);

                // $this->cart->destroy();
                //-------------------------------Order Place & Send Mail-----------------------------------//


                 $table_body = '';
                //print_r($this->cart->contents());die;    
                $subtotal = 0; //sandy 19-03-2021
                foreach ($this->cart->contents() as $cart) {

                    $insert_order = array(
                        'billing_id' => $billing_id,
                        'shipping_id' => '',
                        'user_id' => $user_id,
                        'product_id' => $cart['product_id'],
                        'printing_item' => $cart['priniting_details'],
                        'finishing_item' => $cart['finishing_details'],
                        'price' => $cart['price'],
                        'quantity' => $cart['qty'],
                        'payment_type' => 'cash',
                        'images' => ($cart['image']) ? $cart['image'] : '',
                        'coupon_disc' => $this->session->userdata('coupon'),
                        'delivery_date' => $this->session->userdata('date'),
                        'delivery_time' => $this->session->userdata('delivery_time'),
                        'sales_tax' => $cart['subtotal'] * SALES_TAX_PER, //sandy 18-03-2021 
                        //$this->session->userdata('sales_tax'),
                        'additional_charge' => $this->session->userdata('additional_charges_hid'),
                        'special_instruction' => $this->session->userdata('special_instruction_hid'),
                        'shipping_amount' => $this->input->post('shipping_amount'),
                        'shipping_service_type' => $this->input->post('shipping_service_type'),
                        'total_price' => $this->session->userdata('total_amount'),
                        'shipping_type' => $this->session->userdata('shipping_type'),
                        'pages' => $cart['pages'],
                        'copies' => $cart['copies'],
                        'created_at' => date('Y-m-d H:i:s')
                    );

                    //sandy 18-03-2021
                    $total_cart_items = count($this->cart->contents());
                    $insert_order['shipping_amount'] = (!empty($insert_order['shipping_amount'])) ? $insert_order['shipping_amount'] / $total_cart_items : 0;

                    $insert_order['additional_charge'] = (!empty($insert_order['additional_charge'])) ? $insert_order['additional_charge'] / $total_cart_items : 0;

                    $insert_order['total_price'] = $cart['subtotal'] + $insert_order['sales_tax'] + $insert_order['shipping_amount'] + $insert_order['additional_charge'];

                    $delivery_date_time = $this->session->userdata('date') . '  ' . $this->session->userdata('delivery_time');
                    //print_r($insert_order);die;
                    $this->db->insert('tbl_orders', $insert_order);
                    //echo $this->db->last_query();die;
                    $insert_id = $this->db->insert_id();
                    $order_no_id = '#ORD000' . $insert_id;
                    $this->db->where(array(
                        'id' => $insert_id
                    ));
                    $update_order =  $this->db->update('tbl_orders', array('order_id' => $order_no_id));
                    $total_amount = $this->session->userdata('total_amount');
                    $qty = $cart['qty'];
                    $price = $cart['price'];


                    $product_details = $this->home_model->getRow('tbl_products', array('product_id' => $cart['product_id']));
                    $user_details = $this->home_model->getRow('users', array('id' => $user_id));


                    $printing_item = '<h3>' . $product_details['product_name'] . '</h3>';
                    $printing_item_string = explode(",", $cart['priniting_details']);

                    foreach ($printing_item_string as $printing) {

                        $item_details = explode("||", $printing);
                        $printing_item .= (isset($item_details[0]) ? $item_details[0] : '') . ' : ' . (isset($item_details[1]) ? $item_details[1] : '') . '<br>';
                    }

                    $finishing_item = '';
                    $finishing_item_string = explode(",", $cart['finishing_details']);

                    foreach ($finishing_item_string as $finishing) {

                        $item_details = explode("||", $finishing);
                        $finishing_item .= (isset($item_details[0]) ? $item_details[0] : '') . ' : ' . (isset($item_details[1]) ? $item_details[1] : '') . '<br>';
                    }




                    $no_of_pages = $cart['pages'];
                    $no_of_copies = $cart['copies'];
                    //$subtotal = $this->session->userdata('subtotal');
                    $item_subtotal = $cart['subtotal']; //sandy 19-03-2021
                    $coupon = ($this->session->userdata('coupon')) ? $this->session->userdata('coupon') : 0;
                    $sales_tax = $this->session->userdata('sales_tax');
                    $total_amount = $this->session->userdata('total_amount');
                    $additional_charges_hid = $this->session->userdata('additional_charges_hid');
                    $shipping_amount = $this->input->post('shipping_amount');
                    $shipping_service_type = $this->input->post('shipping_service_type');
                    $shipping_type = $this->session->userdata('shipping_type');
                    $delivery_time = $this->session->userdata('delivery_time');
                    $special_instruction = $this->session->userdata('special_instruction_hid');



                    $table_body .= '<tr>
                                    <td class="desc">' . $printing_item . '</td>
                                    <td class="desc">' . $finishing_item . '</td>
                                    <td class="qty" style="text-align: right;">' . $no_of_pages . '</td>
                                    <td class="unit" style="text-align: right;">' . $no_of_copies . '</td>
                                    <td class="total" style="text-align: right;">' . $item_subtotal . '</td>
                                </tr>'; //sandy 19-03-2021 / 31-03-2021


                    /** 
                        if (isset($cart['image'])) {
                            $cart_images = explode("||", $cart['image']);
                            foreach ($cart_images as $images) {
                                array_push($images_full_path, $images);
                            }
                        }   
                    */

                    //sandy 27-03-21 start
                    if (isset($cart['image'])) {

                        $cart_images = explode("||", $cart['image']);
                        //print_r($cart_images);
                        mkdir('uploads/order_uploads/' . $order_no_id, 0755, true);

                        foreach ($cart_images as $images) {
                            array_push($images_full_path, $images);
                            $dest_path = 'uploads/order_uploads/' . $order_no_id . '/';

                            $file = safe_str_replace('#', '', $images);
                            copy('uploads/files/' . $file, $dest_path . $file);
                        }
                    }

                    //sandy 27-03-21 end
                    $subtotal += $item_subtotal; //sandy 19-03-2021
                }

                $total_amount = $subtotal + $sales_tax + $shipping_amount + $additional_charges_hid - $coupon; //sandy 19-03-2021

                $table_footer = '
				<tr>
				   <td colspan="3"></td>
					<td class="unit" style="text-align: right;"><strong>Subtotal : </strong></td>
					<td class="total" style="text-align: right;">' . number_format($subtotal, 2) . '</td>
				</tr>
				<tr>
				<td colspan="3"></td>
					<td class="unit" style="text-align: right;"><strong>Sales Tax : </strong></td>
					<td class="total" style="text-align: right;">' . number_format($sales_tax, 2) . '</td>
				</tr>
				<tr>
				<td colspan="3"></td>
					<td class="unit" style="text-align: right;"><strong>Additional Charges : </strong></td>
					<td class="total" style="text-align: right;">' . number_format($additional_charges_hid, 2) . '</td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td class="unit" style="text-align: right;"><strong>Shipping Amount : </strong></td>
					<td class="total" style="text-align: right;">' . number_format($shipping_amount, 2) . '</td>
				</tr>
				<tr>
				<td colspan="3"></td>
					<td class="unit" style="text-align: right;"><strong> Coupon Discount : </strong></td>
					<td class="total" style="text-align: right;">' . number_format($coupon, 2) . '</td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td class="unit" style="text-align: right;"><strong>GRAND TOTAL : </strong></td>
					<td class="total" style="text-align: right;">' . number_format($total_amount, 2) . '</td>
				</tr> ';

                // echo $printing_item;
                // echo $finishing_item;
                // echo $table_body;
                // echo $table_footer;die;

                $table_body .= $table_footer;

                $mail_temp = file_get_contents('./global/mail/invoice_template.html');

                $mail_temp = safe_str_replace("{LOGO}", base_url('./assets/frontend/images/logo.png'), $mail_temp);
                $mail_temp = safe_str_replace("{COMPANY_NAME}", "Copymax Inc.", $mail_temp);
                $mail_temp = safe_str_replace("{COMPANY_ADDRESS}", '802 North twin oaks valley road, STE 108, San Marcos, CA 92069', $mail_temp);
                $mail_temp = safe_str_replace("{COMPANY_PHONE}", '1-844-Copymax (2679629)', $mail_temp);
                $mail_temp = safe_str_replace("{COMPANY_EMAIL}", 'info@copymaxinc.com', $mail_temp);
                $mail_temp = safe_str_replace("{COMPANY_EMAIL_NEW}", 'copymaxinc@gmail.com', $mail_temp);

                $mail_temp = safe_str_replace("{CUSTOMER_NAME}", $this->input->post('first_name') . ' ' . $this->input->post('last_name'), $mail_temp);
                $mail_temp = safe_str_replace("{CUSTOMER_MOBILE}", $this->input->post('contact_no'), $mail_temp);
                $mail_temp = safe_str_replace("{CUSTOMER_EMAIL}", ($user_details['email']) ? $user_details['email'] : '', $mail_temp);

                $mail_temp = safe_str_replace("{INVOICE_NUMBER}", $order_no_id, $mail_temp);



                $mail_temp = safe_str_replace("{SHIPPING_ADDRESS}", $shipping_address, $mail_temp);
                $mail_temp = safe_str_replace("{BILLING_ADDRESS}", $billing_address, $mail_temp);
                $mail_temp = safe_str_replace("{SPECIAL_INSTRUCTION}", $special_instruction, $mail_temp);
                $mail_temp = safe_str_replace("{DELIVERY_DATE_TIME}", $delivery_date_time, $mail_temp);
                $mail_temp = safe_str_replace("{TABLE_BODY}", $table_body, $mail_temp);
                $mail_temp = safe_str_replace("{SHIPPING_TYPE}", $shipping_type, $mail_temp);
                $mail_temp = safe_str_replace("{SHIPPING_SERVICE_TYPE}", $shipping_service_type, $mail_temp);




                $user_details = array();
                $user_details = $this->ion_auth->user()->row();
                //print_r($user_details);die;
                $customer_email = isset($user_details->email) ? ',' . $user_details->email : '';
                $data['to'] = $customer_email;
                //$data['to']='amitava.rc25@gmail.com';
                $data['name'] = 'Copymax Inc.';
                $data['subject'] = 'Copymax Inc. - Order Placed';
                $data['message'] = $mail_temp;
                $data['from'] = EMAIL_SMTP_FROM_EMAIL;
                //echo $mail_temp;die;

                $this->sendMailContactUs($data, $images_full_path, $invoice_path = null);
                $data['to'] = "copymaxinc@gmail.com";
                //$data['to'] = "jeanne.west3426@gmail.com"; //sandy 19-03-2021
                /* cash mail */
                $MailStatus = $this->sendMailContactUs($data, $images_full_path, $invoice_path = null);
                // dd($MailStatus);
                /*if (!empty($images_full_path)) {
					 if(!file_exists('uploads/order_uploads/'. $order_no_id)) {
						@mkdir('uploads/order_uploads/'. $order_no_id, 0755, true);
					 }
					 $dest_path = 'uploads/order_uploads/' . $order_no_id . '/';
				foreach ($images_full_path as $file) {
						$file = safe_str_replace('#', '', $file);
						if(is_file('uploads/files/' . $file)) {
							@copy('uploads/files/' . $file, $dest_path . $file);
						}
					} 
				} */ //sandy 27-03-21
                //echo 'success';die;	

                $array_items = array(
                    'id' => '',
                    'product_id' => '',
                    'name' => '',
                    'shipping_type' => '',
                    'image' => '',
                    'price' => '',
                    'price_page' => '',
                    'priniting_details' => '',
                    'finishing_details' => '',
                    'paper_type_id' => '',
                    'dimensions' => '',
                    'copies' => '',
                    'pages' => '',
                    'qty' => '',
                    'status' => '',
                    'digital_proof' => '',
                    'rowid' => '',
                    'subtotal' => '',
                    'date' => '',
                    'shipping_amount' => '',
                    'shipping_service_type' => '',
                    'zip_code' => '',
                    'coupon' => '',
                    'sales_tax' => '',
                    'total_amount' => '',
                    'additional_charges_hid' => '',
                    'special_instruction_hid' => '',
                    'shipping_type' => '',
                    'delivery_time' => ''
                );
                $this->session->unset_userdata($array_items);
                $this->cart->destroy();

                //--------------------------------------END ------------------------------------------------//
                $data['payment_details']['transaction_id'] = 'Cash On Delivery';
                $data['payment_details']['response_code'] = '';
                $data['payment_details']['message_code'] = '';
                $data['payment_details']['auth_code'] = '';
                $data['payment_details']['description'] = '';
                $data['payment_details']['payment_status'] = 1;


                $payment_details = array(
                    'payment_status' => '1',
                    'transaction_id' => 'Cash On Delivery',
                    'response_code' => '',
                    'message_code' => '',
                    'auth_code' => '',
                    'description' => 'Your order has been placed Successfully',
                    'payment_type' => ($this->input->post('payment_method') == 'cod') ? 'cash' : 'No Payment'
                );
                
                $this->session->set_flashdata('success_message', 'Your order has been placed Successfully');
                $this->session->set_flashdata('payment_details', $payment_details);
            }
            //--------------------------------------CASH ON DELIVERY END ------------------------------------------------//


            $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
            $this->_modules = $this->config->item('modules_locations');


            if ($payment_details['payment_status'] == 1) {
                //$data               = array();
                $data['ref'] = $order_no_id;
                //$data['page_title'] = "Order Success";
                $data['module'] = 'welcome';
                $data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "payment_response";
                $this->load->view($this->_container, $data);
            }
        }
    }

    //new sandy 15-05-2021
    private function store_cart_data($data = '', $is_submit = false)
    {
        if ($is_submit && !empty($data)) {
            $table_body = '';
            //echo "<pre>";print_r($data);print_r($this->cart->contents());die;    
            $subtotal = 0;

            $images_full_path = array();
            foreach ($this->cart->contents() as $cart) {
                //print_r($cart); 
                $add_charge = (!empty($this->session->userdata('additional_charges_hid'))) ? $this->session->userdata('additional_charges_hid') : 0;
                $sales_tax = ($cart['subtotal'] + $cart['shipping_amount'] + $add_charge) * SALES_TAX_PER;
                $insert_order = array(
                    'billing_id' => $data['billing_id'],
                    'shipping_id' => $data['shipping_id'],
                    'user_id' => $data['user_id'],
                    'product_id' => $cart['product_id'],
                    'printing_item' => $cart['priniting_details'],
                    'finishing_item' => $cart['finishing_details'],
                    'price' => $cart['price'],
                    'quantity' => $cart['qty'],
                    'payment_type' => $data['payment_type'],
                    'images' => ($cart['image']) ? $cart['image'] : '',
                    //'coupon_disc' => $this->session->userdata('coupon'),
                    'delivery_date' => $cart['completion_date'],
                    'delivery_time' => ($cart['shipping_type'] == 'pick' ? '4:00 PM' : ''),
                    'sales_tax' => $sales_tax, //sandy 17-03-21 
                    //$this->session->userdata('sales_tax'),
                    'additional_charge' => $this->session->userdata('additional_charges_hid'),
                    'special_instruction' => $this->session->userdata('special_instruction_hid'),
                    'shipping_amount' => $cart['shipping_amount'],
                    'shipping_service_type' => $cart['shipping_service_type'],
                    //'total_price' => $this->session->userdata('total_amount'),
                    'shipping_type' => $cart['shipping_type'],
                    'pages' => $cart['pages'],
                    'copies' => $cart['copies'],
                    'created_at' => date('Y-m-d H:i:s')
                );

                //code should be updated last 16-04-2021
                $temp_coupon_discount = ($this->session->userdata('coupon')) ? $this->session->userdata('coupon') : 0;
                $temp_sub_total = $this->session->userdata('subtotal');



                $insert_order['total_price'] = $cart['subtotal'];
                $insert_order['coupon_disc'] = (($cart['subtotal'] * $temp_coupon_discount) / $temp_sub_total);

                $delivery_date_time = $this->session->userdata('date') . '  ' . $this->session->userdata('delivery_time');

                //print_r($insert_order); die;

                $this->db->insert('tbl_orders', $insert_order);

                $insert_id = $this->db->insert_id();
                //$insert_id = 222;
                $order_no_id = '#ORD000' . $insert_id;
                $this->db->where('id', $insert_id);
                $update_order = $this->db->update('tbl_orders', array('order_id' => $order_no_id));

                $product_details = $this->home_model->getRow('tbl_products', array('product_id' => $cart['product_id']));
                $user_details = $this->home_model->getRow('users', array('id' => $data['user_id']));


                $printing_item = '<h3>' . $product_details['product_name'] . '</h3>';
                $printing_item_string = explode(",", $cart['priniting_details']);

                foreach ($printing_item_string as $printing) {

                    $item_details = explode("||", $printing);
                    $printing_item .= (isset($item_details[0]) ? $item_details[0] : '') . ' : ' . (isset($item_details[1]) ? $item_details[1] : '') . '<br>';
                }

                $finishing_item = '';
                $finishing_item_string = explode(",", $cart['finishing_details']);

                foreach ($finishing_item_string as $finishing) {

                    $item_details = explode("||", $finishing);
                    $finishing_item .= (isset($item_details[0]) ? $item_details[0] : '') . ' : ' . (isset($item_details[1]) ? $item_details[1] : '') . '<br>';
                }




                $no_of_pages = $cart['pages'];
                $no_of_copies = $cart['copies'];
                //$subtotal = $this->session->userdata('subtotal');
                $item_subtotal = $cart['subtotal']; //sandy 19-03-2021
                $coupon = ($this->session->userdata('coupon')) ? $this->session->userdata('coupon') : 0;
                $sales_tax = $this->session->userdata('sales_tax');
                $total_amount = $this->session->userdata('total_amount');
                $additional_charges_hid = (!empty($this->session->userdata('additional_charges_hid'))) ? $this->session->userdata('additional_charges_hid') : 0;
                $shipping_amount = $this->input->post('shipping_amount');
                $shipping_service_type = $this->input->post('shipping_service_type');
                $shipping_type = $this->session->userdata('shipping_type');
                $delivery_time = $this->session->userdata('delivery_time');
                $special_instruction = $this->session->userdata('special_instruction_hid');

                //sandy 21-05-2021 
                $ship_info = '<div> <b>Shipping Type : </b>' . ucwords($cart['shipping_type']) . '</div>';
                $ship_info .= '<div> <b>Shipping Service Type : </b>' . $cart['shipping_service_type'] . '</div>';
                $ship_info .= '<div> <b>Shipping Amount : </b> $' . $cart['shipping_amount'] . '</div>';
                $ship_info .= '<div> <b>Delivery Date & Time : </b>' . $insert_order['delivery_date'] . ' ' . $insert_order['delivery_time'] . '</div>';

                $table_body .= '<tr>
								<td class="desc">' . $printing_item . '</td>
								<td class="desc">' . $finishing_item . '</td>
								<td class="desc" style="text-align: left;">' . $ship_info . '</td>
								<td class="qty" style="text-align: right;">' . $no_of_pages . '</td>
								<td class="unit" style="text-align: right;">' . $no_of_copies . '</td>
								<td class="total" style="text-align: right;">' . $item_subtotal . '</td>
							</tr>'; //sandy 19-03-2021 & 31-03-2021 & 30-04-2021*/



                /*$table_body .= '<tr>
								<td class="desc">' . $printing_item . '</td>
								<td class="desc">' . $finishing_item . '</td>
								<td class="qty" style="text-align: right;">' . $no_of_pages . '</td>
								<td class="unit" style="text-align: right;">' . $no_of_copies . '</td>
								<td class="total" style="text-align: right;">' . $item_subtotal . '</td>
							</tr>';//sandy 19-03-2021 & 31-03-2021 & 30-04-2021*/



                //sandy 27-03-21 start
                if (!empty($cart['image'])) {

                    $cart_images = explode("||", $cart['image']);
                    //print_r($cart_images);
                    mkdir('uploads/order_uploads/' . $order_no_id, 0755, true);

                    foreach ($cart_images as $images) {
                        array_push($images_full_path, $images);
                        $dest_path = 'uploads/order_uploads/' . $order_no_id . '/';

                        $file = safe_str_replace('#', '', $images);
                        copy('uploads/files/' . $file, $dest_path . $file);
                    }
                }

                //sandy 27-03-21 end

                /*if (!empty($images_full_path['0'])) {
					mkdir('uploads/order_uploads/' . $order_no_id, 0755, true);
					$dest_path = 'uploads/order_uploads/' . $order_no_id . '/';
					foreach ($images_full_path as $file) {
						$file = safe_str_replace('#', '', $file);
						copy('uploads/files/' . $file, $dest_path . $file);
					}
				}*/

                $subtotal += $item_subtotal; //sandy 19-03-2021
            }
            //die;
            $total_amount = $subtotal + $sales_tax + $shipping_amount + $additional_charges_hid - $coupon; //sandy 19-03-2021
            $tf_colspan = 3; // sandy 30-04-2021
            $table_footer = '<tfoot>
				<tr>
					<td colspan="' . $tf_colspan . '"></td>
					<td colspan="2" class="unit" style="text-align: right;"><strong>Subtotal : </strong></td>
					<td class="total" style="text-align: right;">' . number_format($subtotal, 2) . '</td>
				</tr>
				<tr>
					<td colspan="' . $tf_colspan . '"></td>
					<td colspan="2" class="unit" style="text-align: right;"><strong>Additional Charges : </strong></td>
					<td class="total" style="text-align: right;">' . number_format($additional_charges_hid, 2) . '</td>
				</tr>
				<tr>
					<td colspan="' . $tf_colspan . '"></td>
					<td colspan="2" class="unit" style="text-align: right;"><strong>Shipping Amount : </strong></td>
					<td class="total" style="text-align: right;">' . number_format($shipping_amount, 2) . '</td>
				</tr>
				<tr>
					<td colspan="' . $tf_colspan . '"></td>
					<td colspan="2" class="unit" style="text-align: right;"><strong>Sales Tax : </strong></td>
					<td class="total" style="text-align: right;">' . number_format($sales_tax, 2) . '</td>
				</tr>
				<tr>
					<td colspan="' . $tf_colspan . '"></td>
					<td colspan="2" class="unit" style="text-align: right;"><strong> Coupon Discount : </strong></td>
					<td class="total" style="text-align: right;">' . number_format($coupon, 2) . '</td>
				</tr>
				<tr>
					<td colspan="' . $tf_colspan . '"></td>
					<td colspan="2" class="unit" style="text-align: right;"><strong>GRAND TOTAL : </strong></td>
					<td class="total" style="text-align: right;">' . number_format($total_amount, 2) . '</td>
				</tr> 
				</tfoot>';

            // echo $printing_item;
            // echo $finishing_item;
            // echo $table_body;
            // echo $table_footer;die;

            $table_body .= $table_footer;

            $mail_temp = file_get_contents('./global/mail/invoice_template_new.html');

            $mail_temp = safe_str_replace("{LOGO}", base_url('./assets/frontend/images/logo.png'), $mail_temp);
            $mail_temp = safe_str_replace("{COMPANY_NAME}", "Copymax Inc.", $mail_temp);
            $mail_temp = safe_str_replace("{COMPANY_ADDRESS}", '802 North twin oaks valley road, STE 108, San Marcos, CA 92069', $mail_temp);
            $mail_temp = safe_str_replace("{COMPANY_PHONE}", '1-844-Copymax (2679629)', $mail_temp);
            $mail_temp = safe_str_replace("{COMPANY_EMAIL}", 'info@copymaxinc.com', $mail_temp);
            $mail_temp = safe_str_replace("{COMPANY_EMAIL_NEW}", 'copymaxinc@gmail.com', $mail_temp);

            $mail_temp = safe_str_replace("{CUSTOMER_NAME}", $this->input->post('first_name') . ' ' . $this->input->post('last_name'), $mail_temp);
            $mail_temp = safe_str_replace("{CUSTOMER_MOBILE}", $this->input->post('contact_no'), $mail_temp);
            $mail_temp = safe_str_replace("{CUSTOMER_EMAIL}", ($user_details['email']) ? $user_details['email'] : '', $mail_temp);

            $mail_temp = safe_str_replace("{INVOICE_NUMBER}", $order_no_id, $mail_temp);



            $mail_temp = safe_str_replace("{SHIPPING_ADDRESS}", $data['shipping_address'], $mail_temp);
            $mail_temp = safe_str_replace("{BILLING_ADDRESS}", $data['billing_address'], $mail_temp);
            $mail_temp = safe_str_replace("{SPECIAL_INSTRUCTION}", $special_instruction, $mail_temp);
            $mail_temp = safe_str_replace("{DELIVERY_DATE_TIME}", $delivery_date_time, $mail_temp);
            $mail_temp = safe_str_replace("{TABLE_BODY}", $table_body, $mail_temp);
            $mail_temp = safe_str_replace("{SHIPPING_TYPE}", $shipping_type, $mail_temp);
            $mail_temp = safe_str_replace("{SHIPPING_SERVICE_TYPE}", $shipping_service_type, $mail_temp);



            //echo $mail_temp;die;

            $user_details = array();
            $user_details = $this->ion_auth->user()->row();
            //print_r($user_details);die;
            $customer_email = isset($user_details->email) ? ',' . $user_details->email : '';
            $data['to'] = $customer_email;
            //$data['to']='arindam.biswas@met-technologies.com,arindamkbiswas@gmail.com,fitser.usa@gmail.com';
            $data['name'] = 'Copymax Inc.';
            $data['subject'] = 'Copymax Inc. - Order Placed';
            $data['message'] = $mail_temp;
            $data['from'] = EMAIL_SMTP_FROM_EMAIL;
            //echo $mail_temp;die;

            $this->sendMailContactUs($data, $images_full_path, $invoice_path = null);

            if ($customer_email != "copymaxinc@gmail.com") {
                $data['to'] = "copymaxinc@gmail.com";
                //$data['to'] = "jeanne.west3426@gmail.com"; //sandy 19-03-2021

                /* cash mail */

                $this->sendMailContactUs($data, $images_full_path, $invoice_path = null);
            }


            /*if (!empty($images_full_path['0'])) {
				mkdir('uploads/order_uploads/' . $order_no_id, 0755, true);
				$dest_path = 'uploads/order_uploads/' . $order_no_id . '/';
				foreach ($images_full_path as $file) {
					$file = safe_str_replace('#', '', $file);
					copy('uploads/files/' . $file, $dest_path . $file);
				}
			}*/ //sandy 27-03-23
            //echo 'success';die;	

            $array_items = array(
                'id' => '',
                'product_id' => '',
                'name' => '',
                'shipping_type' => '',
                'image' => '',
                'price' => '',
                'price_page' => '',
                'priniting_details' => '',
                'finishing_details' => '',
                'paper_type_id' => '',
                'dimensions' => '',
                'copies' => '',
                'pages' => '',
                'qty' => '',
                'status' => '',
                'digital_proof' => '',
                'rowid' => '',
                'subtotal' => '',
                'date' => '',
                'shipping_amount' => '',
                'shipping_service_type' => '',
                'zip_code' => '',
                'coupon' => '',
                'sales_tax' => '',
                'total_amount' => '',
                'additional_charges_hid' => '',
                'special_instruction_hid' => '',
                'shipping_type' => '',
                'delivery_time' => ''
            );
            $this->session->unset_userdata($array_items);
            $this->cart->destroy();
            return $order_no_id;
        }
    }




    private function authorized($address, $order)
    {
        //print_r($address);die;
        $data       = array();
        $total      = $this->input->post('total');
        $total         = number_format((float)$total, 2, '.', '');
        $Rrand      = rand(1000, 99999);
        $card_no    = $this->input->post('card_no');
        $exp_date   = $this->input->post('exp_date');
        $CardCode   = $this->input->post('card_code');
        $f_name     = $address['first_name'];
        $l_name     = $address['last_name'];
        $email      = $address['email'];
        $phone      = $address['phone'];
        $customer_address    = $address['address'];
        $city       = $address['city'];
        $state      = $address['state'];
        $county     = $address['country'];
        $zip_code   = $address['zip_code'];

        $cart_grand_total   = $total;
        //$arr = $arr1 = $order = $order_details = array();

        $user_id = $order['user_id'];
        $ds = DIRECTORY_SEPARATOR;
        $base_dir = realpath(dirname(__FILE__)  . $ds . '../../../') . $ds;
        //echo "{$base_dir}\CodeIgniter3\application\third_party/authorize-sdk/vendor/autoload.php"; exit();
        //echo $base_dir; die();
        require_once("{$base_dir}third_party/authorize-sdk/vendor/autoload.php");
        //define("AUTHORIZENET_LOG_FILE","phplog");

        // Common setup for API credentials  
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();


        //$merchantAuthentication->setName("39pQbSPs8Y");                    //Sandbox
        //$merchantAuthentication->setTransactionKey("9Ph7T3a6T35q9C7f");   //Sandbox

        $merchantAuthentication->setName("44HYne7G6");                     //Sandbox --39pQbSPs8Y //LIve -- 44HYne7G6
        $merchantAuthentication->setTransactionKey("3Yj33L23zKfqg5VL");     //Sandbox -- 9Ph7T3a6T35q9C7f //Live -- 3Yj33L23zKfqg5VL

        $refId = 'ref' . time();

        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($card_no);
        $creditCard->setExpirationDate($exp_date);
        $creditCard->setCardCode($CardCode);

        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create order information
        $order = new AnetAPI\OrderType();
        $order->setInvoiceNumber($Rrand);
        $order->setDescription("Goods & Services");

        // Set the customer's Bill To address
        $customerAddress = new AnetAPI\CustomerAddressType();
        $customerAddress->setFirstName($f_name);
        $customerAddress->setLastName($l_name);
        $customerAddress->setAddress($customer_address);
        $customerAddress->setCity($city);
        $customerAddress->setState($state);
        $customerAddress->setZip($zip_code);
        $customerAddress->setCountry($county);
        $customerAddress->setPhoneNumber($phone);

        // print_r($customerAddress);die;

        // Set the customer's identifying information
        $customerData = new AnetAPI\CustomerDataType();
        $customerData->setType("individual");
        $customerData->setEmail($email);

        // Create a customer shipping address
        $customerShippingAddress = new AnetAPI\CustomerAddressType();
        $customerShippingAddress->setFirstName($f_name);
        $customerShippingAddress->setLastName($l_name);
        $customerShippingAddress->setAddress($customer_address);
        $customerShippingAddress->setCity($city);
        $customerShippingAddress->setState($state);
        $customerShippingAddress->setZip($zip_code);
        $customerShippingAddress->setCountry($county);
        $customerShippingAddress->setPhoneNumber($phone);

        // Create a new CustomerPaymentProfile object
        $paymentProfile = new AnetAPI\CustomerPaymentProfileType();
        $paymentProfile->setCustomerType('individual');
        $paymentProfile->setBillTo($customerAddress);

        $paymentProfile->setPayment($paymentOne);
        $paymentProfile->setDefaultpaymentProfile(true);
        $paymentProfiles[] = $paymentProfile;

        // Create a transaction
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($total);
        $transactionRequestType->setOrder($order);
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setBillTo($customerAddress);
        $transactionRequestType->setCustomer($customerData);
        //$transactionRequestType->setShipTo($customerShippingAddress);
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);
        
        $controller = new AnetController\CreateTransactionController($request);
        // $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);  //Sandbox 
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION); //Live
        // die;
        // return $response;
    }

    public function forget_password()
    {

        if (isset($_POST['forget_password'])) {
            $this->form_validation->set_rules('user_email', 'User Email', 'trim|required');

            if ($this->form_validation->run() != FALSE) {
                $user_email = $this->input->post('user_email');
                $result     = $this->home_model->checkUserByEmail($user_email);

                if (count($result) > 0) {
                    $forgotten = $this->ion_auth->forgotten_password($user_email);
                    //echo count($forgotten)."<br>";
                    //echo $forgotten['forgotten_password_code']."<br>";
                    //echo"<pre>"; print_r($forgotten); exit;

                    //$forget_link = base_url()."my-account/reset-password?key=".$forgotten['forgotten_password_code'];
                    $forget_link = base_url() . "my-account/reset-password/" . $forgotten['forgotten_password_code'];

                    $message = "<html>
                                    <head>
                                    <title>Forgot Password</title>
                                    </head>
                                    <body>
                                    <p>Hi Dear,</p>
                                    <p>&nbsp;</p>
                                    <p>Click <a href='$forget_link'>here</a> to reset your account password.</p>
                                    <p>&nbsp;</p>
                                    <p>Best Regards,<br/>Copymax Inc. Team</p>
                                    </body>
                                    </html>";

                    $data['to'] = $this->input->post('user_email');
                    //$data['to']='arindam.biswas@met-technologies.com';
                    //$data['to']='arindam.biswas@met-technologies.com,shubhadeep.chowdhury@met-technologies.com';
                    $data['name'] = 'Copymax Inc.';
                    $data['subject'] = 'Forgot Password';
                    $data['message'] = $message;

                    if ($this->sendMail($data)) {
                        $this->session->set_flashdata('message', 'Please check your email to reset your account password.');
                    } else {
                        $this->session->set_flashdata('message', 'Please try again.');
                    }
                } else {
                    $this->session->set_flashdata('message', 'User not registered with us!');
                }

                redirect(base_url("login"), 'refresh');
            }
        }
    }

    public function reset_password()
    {

        $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules   = $this->config->item('modules_locations');

        $forget_code = end($this->uri->segments);

        //$code = $this->input->get('key');
        $data         = array();
        $data['code'] = $forget_code;

        if (isset($_POST['reset_password'])) {

            $this->form_validation->set_rules('password_1', 'Password 1', 'trim|required');
            $this->form_validation->set_rules('password_2', 'Password 2', 'trim|required');

            $password1 = $this->input->post('password_1');
            $password2 = $this->input->post('password_2');

            if ($password1 == $password2) {
                $reset = $this->ion_auth->forgotten_password_complete($forget_code, $password1);

                if ($reset) {
                    //if the reset worked then send them to the login page
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                } else {
                    //if the reset didnt work then send them back to the forgot password page
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    //redirect("auth/forgot_password", 'refresh');                    
                }
            } else {
                $this->session->set_flashdata('message', "Password doesn't match. Please try again.");
            }

            redirect(base_url("login"), 'refresh');
        }

        $data['page_title'] = "Reset Password";
        $data['page']       = $this->config->item('bootsshop_template_dir_welcome') . "resetpassword";
        $data['module']     = 'welcome';
        $this->load->view($this->_container, $data);
    }


    // Manage Addresses 
    public function manage_addresses()
    {
        //$user_id = '1';  // that would be the login user id
        if ($this->ion_auth->get_user_id() == "") {
            redirect('cart');
        } else {
            $user_id = $this->ion_auth->get_user_id();
        }
        if (isset($_POST['submit'])) {


            //echo  "here111";die;
            if ($this->input->post('is_default') == "") {
                $is_deafult = '0';
            } else {
                $is_deafult = $this->input->post('is_default');
            }
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('title', 'title', 'trim|required');
            $insert_data = array(
                'user_id' => $user_id,
                'title' => $this->input->post('title'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'zip_code' => $this->input->post('zip_code'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'is_default' => $is_deafult,
                'created_at' => date('Y-m-d H:i:s')
            );
            $this->db->insert('tbl_user_address', $insert_data);
            $this->session->set_flashdata('success_message', 'Address Added Successfully');
            redirect('welcome/index/manage_addresses');
        }
        $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules   = $this->config->item('modules_locations');

        $data                 = array();
        //$page_slug = 'contact-us'; 
        //$data['page_slug'] = $page_slug; 

        $data['page_content'] = $this->home_model->Show_Address_Book($user_id);

        //print_r($data['page_content']);

        $data['page_title'] = "Manage Addresses";
        $data['page']       = $this->config->item('bootsshop_template_dir_welcome') . "manageadresses";
        $data['module']     = 'welcome';

        //echo "<pre>";print_r($data['content']);exit();

        $this->load->view($this->_container, $data);
    }
    // Update view open 
    public function update_addresses()
    {
        $tbl_user_address_id = $this->input->post('tbl_user_address_id');
        $this->db->select('*');
        $this->db->from('tbl_user_address');
        $this->db->where(array(
            'tbl_user_address.id' => $tbl_user_address_id
        ));
        $query  = $this->db->get();
        $result = $query->row_array();
        echo json_encode($result);
    }

    public function update_manage_addresses()
    {
        $user_id = $this->input->post('user_id');
        if ($this->input->post('is_default') == "") {
            $is_deafult = '0';
        } else {
            $is_deafult = $this->input->post('is_default');
        }
        $update_data = array(
            'title' => $this->input->post('title'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'company' => $this->input->post('company'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'address' => $this->input->post('address'),
            'zip_code' => $this->input->post('zip_code'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'is_default' => $is_deafult
        );
        $this->db->where(array(
            'id' => $this->input->post('tbl_user_address_id')
        ));
        $this->db->update('tbl_user_address', $update_data);

        $this->session->set_flashdata('success_message', 'Address Updated Successfully');

        redirect('welcome/index/manage_addresses/' . $user_id);
    }

    public function delete_manage_addresses()
    {
        $user_id         = $this->input->post('user_id1');
        $condition['id'] = $this->input->post('tbl_user_address_id1');
        $this->db->delete('tbl_user_address', $condition);
        $this->session->set_flashdata('success_message', 'Address Deleted Successfully');
        redirect('welcome/index/manage_addresses/' . $user_id);
    }

    public function edit_profile()
    {
        $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules   = $this->config->item('modules_locations');
        if ($this->ion_auth->logged_in()) {
            $user_id            = $this->ion_auth->get_user_id();
            $where              = 'users.id';
            $data['users_data'] = $this->home_model->get_data('users', $where, $user_id);
        }
        if ($this->input->post('save_changes') == 'save changes') {

            $this->form_validation->set_rules('f_name', 'First Name', 'trim|required');
            if (safe_trim($this->input->post('new_password')) != '') {
                $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
                $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');
            }
            if ($this->form_validation->run() == TRUE) {



                $update_data['ip_address'] = $this->get_client_ip_env();
                $update_data['first_name'] = $this->input->post('f_name');
                $update_data['last_name'] = $this->input->post('l_name');
                $update_data['phone_tel_no'] = $this->input->post('phone_tel_no');
                $update_data['phone'] = $this->input->post('mobile');


                if (safe_trim($this->input->post('new_password')) != '') {

                    $post_data = $this->input->post();
                    $res = $this->ion_auth->change_password($post_data);
                    if (!$res) {
                        $this->session->set_flashdata('update_message_error', '<strong>Existing Password did not match</strong>.');
                        redirect(base_url() . 'editprofile');
                    }
                    //print_r($res);die;

                }


                if ($this->home_model->Update_user($user_id, $update_data)) {
                    $this->session->set_flashdata('update_message_success', '<strong></strong> Record Updated successfully.');
                    redirect(base_url() . 'editprofile');
                } else {
                    $this->session->set_flashdata('update_message_error', '<strong>Something wrong!!!</strong>.');
                    redirect(base_url() . 'editprofile');
                }
            } else {

                $data['page_title'] = "Manage Profile";
                $data['page']       = $this->config->item('bootsshop_template_dir_welcome') . "editprofile";
                $data['module']     = 'welcome';
                $this->load->view($this->_container, $data);
            }
        }
        $data['page_title'] = "Manage Profile";
        $data['page']       = $this->config->item('bootsshop_template_dir_welcome') . "editprofile";
        $data['module']     = 'welcome';
        $this->load->view($this->_container, $data);
    }

    public function order_list()
    {
        $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules   = $this->config->item('modules_locations');
        if ($this->ion_auth->logged_in()) {
            $user_id            = $this->ion_auth->get_user_id();
            $where              = 'tbl_orders.user_id';
            $data['order_list'] = $this->home_model->get_order_data($user_id);
        }

        $data['page_title'] = "Order Details";
        $data['page']       = $this->config->item('bootsshop_template_dir_welcome') . "order_list";
        $data['module']     = 'welcome';
        $this->load->view($this->_container, $data);
    }


    public function logout()
    {
        $this->ion_auth->logout();
        $this->cart->destroy();
        redirect(base_url());
    }

    public function get_client_ip_env()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }

    public function question()
    {
        $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules   = $this->config->item('modules_locations');

        $data['page_title'] = "Question";
        $data['page']       = $this->config->item('bootsshop_template_dir_welcome') . "faq_bleed";
        $data['module']     = 'welcome';
        $this->load->view($this->_container, $data);
    }

    public function add_quote()
    {

        // $mail_temp = file_get_contents('./global/mail/Invoice_pending.html');
        // $mail_temp=safe_str_replace("{COMPANY_NAME}","Punjab Motor Work Shop",$mail_temp);
        // $mail_temp=safe_str_replace("{COMPANY_PHONE}",$company_details['phone'],$mail_temp);
        // $mail_temp=safe_str_replace("{COMPANY_EMAIL}",$company_details['email'],$mail_temp);
        // $mail_temp=safe_str_replace("{logo}",$this->logo,$mail_temp);
        // $mail_temp=safe_str_replace("{name}",$customer['customer_name'],$mail_temp);
        // $mail_temp=safe_str_replace("{INVOICE_NUMBER}",$customer['invoice_no'],$mail_temp);
        // $mail_temp=safe_str_replace("{INVOICE_TOTAL_AMOUNT}",$customer['total_amount'],$mail_temp);
        // $mail_temp=safe_str_replace("{INVOICE_PAID_AMOUNT}",$total_payment,$mail_temp);
        // $mail_temp=safe_str_replace("{INVOICE_DUE_AMOUNT}",$due_amount,$mail_temp);
        // $mail_temp=safe_str_replace("{current_year}",CURRENT_YEAR,$mail_temp);
        // $mail_temp=safe_str_replace("{web_url}",base_url(),$mail_temp);

        // $data['to']=$customer['customer_email'];
        // $data['name']='Punjab Motor Work Shop';
        // $data['subject']='Punjab Motor Work Shop - Payment Pending';
        // $data['message']=$mail_temp;
        // $data['from']='punjabmotorworkshop@gmail.com';				

        // if($this->sendMail($data)){
        // 	echo 'success';
        // }
        // else{
        // 	echo 'failed';
        // }

        $return_data = array('status' => true);
        echo json_encode($return_data);
    }


    private function sendContactUsMail($data, $image_full_path = null, $invoice_path = null)
    {
        $config = get_updated_smtp_config();
        $this->email->initialize($config);
        $this->email->set_crlf("\r\n");
        $this->email->from('query@copymaxinc.com', 'Copymax Inc.');
        //$this->email->reply_to('Reply',$data['from']);
        $this->email->to($data['to']);
        //$this->email->bcc("copymaxinc@gmail.com");       
        $this->email->subject($data['subject']);
        $this->email->message($data['message']);

        if ($this->email->send()) {

            return true;
        } else {

            return false;
        }
    }

    private function sendMail($data, $image_full_path = null, $invoice_path = null)
    {
        $config = get_updated_smtp_config();
        $this->email->initialize($config);
        $this->email->set_crlf("\r\n");
        $this->email->from(EMAIL_SMTP_FROM_EMAIL, EMAIL_SMTP_FROM_NAME);
        $this->email->to($data['to']);
        $this->email->subject($data['subject']);
        $this->email->message($data['message']);

        //print_r($image_full_path);die;
        if (!empty($image_full_path)) {
            foreach ($image_full_path as $file) {
                $this->email->attach(base_url('uploads/files/' . $file));
            }
        }
        // if (!empty($invoice_path)) {
        //     $this->email->attach(base_url($invoice_path));
        // }				
        if ($this->email->send()) {
            return true;
        } else {
            // dd($this->email->print_debugger());
            return false;
        }
    }


    private function sendMailContactUs($data, $image_full_path = null, $invoice_path = null)
    {
        $config = get_updated_smtp_config();
        $this->email->initialize($config);
        $this->email->set_crlf("\r\n");
        $this->email->from(EMAIL_SMTP_FROM_EMAIL, EMAIL_SMTP_FROM_NAME);
        $this->email->to($data['to']);
        $this->email->subject($data['subject']);
        //$data['message'] = substr($data['message'],0, 8190);
        $this->email->message($data['message']);

        //print_r($image_full_path);die;
        /* if (!empty($image_full_path)) {
            foreach ($image_full_path as $file) {
                $this->email->attach(base_url('uploads/files/' . $file));
            }
        } */
        // if (!empty($invoice_path)) {
        //     $this->email->attach(base_url($invoice_path));
        // }				
        if ($this->email->send()) {

            return true;
        } else {
            // dd($this->email->print_debugger());
            return false;
        }
    }





    // private function sendMail($data)
    // {

    //     $config = get_updated_smtp_config();
    //     $this->email->initialize($config);

    //     $this->email->set_crlf("\r\n");

    //     $this->email->from('info@copymaxinc.com', 'Copymax');
    //     $this->email->to($data['to']);
    //     //$this->email->to('amitava.rc25@gmail.com'); 

    //     $this->email->subject($data['subject']);
    //     $this->email->message($data['message']);

    //     if ($this->email->send()) {

    //         return true;
    //     } else {
    //         //return false;
    //         print_r($this->email->print_debugger());die;
    //     }
    // }


    // public function update_password(){ 
    //     if($this->input->post('new_password') == $this->input->post('confirm_password')){
    //      $post_data = $this->input->post();
    //   if(!empty($post_data)){
    //    $res = $this->ion_auth->change_password($post_data);
    //    if($res==1){
    //     $this->session->set_flashdata('success', $this->lang->line('password_update'));
    //    }else{
    //     $this->session->set_flashdata('error', $this->lang->line('password_mismatch'));
    //    }
    //    redirect(base_url(get_current_language().'/my-account')); 
    //   }
    //     }else{
    //      $this->session->set_flashdata('error', $this->lang->line('password_mismatch'));
    //      redirect(base_url(get_current_language().'/my-account')); 
    //     }
    // }

}
