/* sending the mail */
				
			    $get['new_blog'] = $this->blog_model->get_latest_blog();
		        $get['emails'] = $this->blog_model->get_emails();
		        
		        $latestblog = $get['new_blog'];
		        
		        $emails_all = $get['emails'];
		        
		        $elements = array();
		        
		        foreach($emails_all as $news){
		           $elements[] = $news['email'];
            	   $all = implode(",",$elements);
            	  }
		        
		    if ($get['new_blog']!=''){
			    $config = Array(
                        'protocol' => 'mail',
                        'smtp_host' => 'redbeanhospitality.com',
                        'smtp_port' => 587,
                        'smtp_user' => 'admin@redbeanhospitality.com', // change it to yours
                        'smtp_pass' => 'user123#', // change it to yours
                        'smtp_timeout'=>20,
                        'mailtype' => 'html',
                        'charset' => 'utf-8',
                        'wordwrap' => TRUE
                        );
						
						$subject = 'Something new in Redbean!';
						
						//$headersrc = base_url().'assets/email-template/email-header.png';
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from('admin@redbeanhospitality.com', 'Redbean Hospitality'); // change it to yours
						$this->email->to($all);
						$this->email->bcc('admin@redbeanhospitality.com');						
						$this->email->subject($subject);
						$body = '<h1>New Blog!</h1>';
						$img = "";
						foreach($latestblog as $new){
						    $get_img = $new['blog_image'];
						    $img = base_url()."assets/uploads/blog/".$get_img;
						    $title = substr($new['blog_title'],0,15).'...';
						    $content = substr($new['blog_description'],0,32).'...';
						    $more = base_url()."blog/".$new['blog_slug'];
						    
						    $body.="<img src='$img'>
						    <h1>$title</h1>
						    <p>$content</p>
						    <p><a href='$more' target='_blank'>Read More</a></p>
						    ";
						}

						$this->email->message($body);	
						//echo $body;
						/*if($this->email->send()){
							echo "Mail Sent!";
						}
						else{
							 echo $this->email->print_debugger();
						}*/
						//if ($get_img){
						    $this->email->send();
						//}
		        }
