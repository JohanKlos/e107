<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system - Tiny MCE controller file.
|
|     $URL$
|     $Id$
+----------------------------------------------------------------------------+
*/
$_E107['no_online'] = true;
require_once("../../class2.php");
ob_start();
ob_implicit_flush(0);
header("last-modified: " . gmdate("D, d M Y H:i:s",mktime(0,0,0,15,2,2004)) . " GMT");
header('Content-type: text/javascript', TRUE);


$wy = new wysiwyg();

echo_gzipped_page(); 

class wysiwyg
{
	var $js;
	var $config = array();
	var $configName;


	function __construct($config=FALSE)
	{

		$this->getConfig($config);
		$pref = e107::getConfig();

	/*
	if(strstr(varset($_SERVER["HTTP_ACCEPT_ENCODING"],""), "gzip") && (ini_get("zlib.output_compression") == false) && file_exists(e_PLUGIN."tinymce/tiny_mce_gzip.php"))
	{
		//unset($tinymce_plugins[7]); // 'zoom' causes an error with the gzip version.
		$text = "<script type='text/javascript' src='".e_PLUGIN_ABS."tinymce/tiny_mce_gzip.js'></script>

		<script type='text/javascript'>
		tinyMCE_GZ.init({
			plugins : '".implode(",",$tinymce_plugins)."',
			themes : 'advanced',
			languages : '".$tinylang[$lang]."',
			disk_cache : false,
			debug : false
		});
		</script>
		";
	}
	else
	{*/
	//	$text = "<script type='text/javascript' src='".e_PLUGIN_ABS."tinymce/tiny_mce.js'></script>\n";
	//}



//	$text .= "<script type='text/javascript'>\n";
	$text .= "\n /* TinyMce Config: ".$this->configName." */";
	$text .= $this->tinyMce_config();

	$text .= "\t\t 
	$(document).ready(function()
{
	start_tinyMce(); \n
}); ";
	
	$text .= "

	function tinymce_e107Paths(type, source) {
	       
	   
	";

	$tp = e107::getParser();

	$paths = array(
		e107::getFolder('images'),
		e107::getFolder('plugins'),
	//	e107::getFolder('media_images'), //XXX Leave disabled - breaks thumb.php={e_MEDIA_IMAGE} which is required.  
		e107::getFolder('media_files'),
		e107::getFolder('media_videos')
	);


	 $text .= "
	    switch (type) {

	        case 'get_from_editor':
	            // Convert HTML to e107-BBcode
	            source = source.replace(/target=\"_blank\"/, 'rel=\"external\"');
	        //    source = source.replace(/^\s*|\s*$/g,'');

			";

			// Convert TinyMce Paths to  e107 paths.
			foreach($paths as $k=>$path)
			{
				//echo "<br />$path = ".$tp->createConstants($path);
				$text .=  "\t\tsource = source.replace(/(\"|])".str_replace("/","\/",$path)."/g,'$1".$tp->createConstants($path)."');\n";
			}

			$text .= "
            break;

	        case 'insert_to_editor': // Convert e107Paths for TinyMce

	            source = source.replace(/rel=\"external\"/, 'target=\"_blank\"');
	            
	      

			";

			// Convert e107 paths to TinyMce Paths.
			foreach($paths as $k=>$path)
			{
				$const = str_replace("}","\}",$tp->createConstants($path));
				$text .= "\t\tsource = source.replace(/".$const."/gi,'".$path."');\n";
			}

			$text .= "
	        break;
	    }

	    return source;
	}

	 // ]]>
	function triggerSave()
	{
	  tinyMCE.triggerSave();
	}


	";
	
	//$text .= "</script>\n";

		$this->js = $text;
		$this->render();

	}

	function tinymce_lang()
	{
		$lang = e_LANGUAGE;
		$tinylang = array(
			"Arabic" 	=> "ar",
			"Bulgarian"	=> "bg",
			"Danish" 	=> "da",
			"Dutch" 	=> "nl",
			"English" 	=> "en",
			"Persian" 	=> "fa",
			"French" 	=> "fr",
			"German"	=> "de",
			"Greek" 	=> "el",
			"Hebrew" 	=> " ",
			"Hungarian" => "hu",
			"Italian" 	=> "it",
			"Japanese" 	=> "ja",
			"Korean" 	=> "ko",
			"Norwegian" => "nb",
			"Polish" 	=> "pl",
			"Russian" 	=> "ru",
			"Slovak" 	=> "sk",
			"Spanish" 	=> "es",
			"Swedish" 	=> "sv"
		);

		if(!$tinylang[$lang])
		{
		 	$tinylang[$lang] = "en";
		}

		return $tinylang[$lang];
	}


	function tinyMce_config()
	{
		$text = "

	function start_tinyMce()
	{
	    //<![CDATA[

		tinyMCE.init({ \n\n";

		$newConfig = array();

		foreach($this->config as $key=>$val)
		{
			if($val != 'true' && $val !='false')
			{
				$val = "'".$val."'";
			}
			$newConfig[] = "\t\t  ".$key." : ".$val;
		}

		$text .= implode(",\n",$newConfig);
		$text .= "
		});

	}

";

		 return $text;
	}



	function getConfig($config=FALSE)
	{
		$tp = e107::getParser();	
		$fl = e107::getFile();
				
		if(getperms('0'))
		{
			$template = "mainadmin.xml";		
		}
		elseif(ADMIN)
		{
			$template = "admin.xml";			
		}
		elseif(USER)
		{
			$template = "member.xml";			
		}
		else
		{
			$template = "public.xml";			
		}
		
		$configPath = (is_readable(THEME."templates/tinymce/".$template)) ? THEME."templates/tinymce/".$template : e_PLUGIN."tinymce/templates/".$template;
		$config 	= e107::getXml()->loadXMLfile($configPath, true); 


		//TODO Cache!

		$plug_array = explode(",",$config['tinymce_plugins']);
		$this->configName = $config['tinymce_name'];

		$this->config = array(
			'language'			=> $this->tinymce_lang(),
			'mode'				=> 'specific_textareas',
			'editor_selector' 	=> 'e-wysiwyg',
			'editor_deselector'	=> 'e-wysiwyg-off',
			'theme'				=> 'advanced',
			'skin'				=> 'bootstrap', // See https://github.com/gtraxx/tinymce-skin-bootstrap
			'plugins'			=> $this->filter_plugins($config['tinymce_plugins'])
		);

	
		$cssFiles = $fl->get_files(THEME,"\.css",'',2);
		
		
		foreach($cssFiles as $val)
		{
			$css[] = str_replace(THEME,THEME_ABS,$val['path'].$val['fname']);	
		}
		$css[] = "{e_WEB_ABS}js/bootstrap/css/bootstrap.min.css";
		$content_css = vartrue($config['content_css'], implode(",",$css)); 
		
		$content_styles = array('Bootstrap Button' => 'btn btn-primary', 'Bootstrap Table' => 'table');



		$this->config += array(

			'theme_advanced_buttons1'			=> $config['tinymce_buttons1'],
			'theme_advanced_buttons2'			=> vartrue($config['tinymce_buttons2']),
			'theme_advanced_buttons3'			=> vartrue($config['tinymce_buttons3']),
			'theme_advanced_buttons4'			=> vartrue($config['tinymce_buttons4']),
			'theme_advanced_toolbar_location'	=> vartrue($config['theme_advanced_toolbar_location'],'top'),
			'theme_advanced_toolbar_align'		=> 'left',
			'theme_advanced_blockformats' 		=> 'p,h2,h3,h4,h5,h6,blockquote,pre,code',
			'theme_advanced_styles'				=> str_replace(array("+")," ",http_build_query($content_styles)),  //'Bootstrap Button=btn btn-primary;Bootstrap Table=table;border=border;fborder=fborder;tbox=tbox;caption=caption;fcaption=fcaption;forumheader=forumheader;forumheader3=forumheader3',
		
			// 'theme_advanced_resize_vertical' 		=> 'true',
			'dialog_type' 						=> "modal",		
		//	'theme_advanced_source_editor_height' => '400',
            
            // ------------- html5 Stuff. 
		
		    //  'visualblocks_default_state'   => 'true',

                // Schema is HTML5 instead of default HTML4
           //     'schema'     => "html5",
        
                // End container block element when pressing enter inside an empty block
           //     'end_container_on_empty_block' => true,
        
                // HTML5 formats
                /*
                'style_formats' => "[
                        {title : 'h1', block : 'h1'},
                        {title : 'h2', block : 'h2'},
                        {title : 'h3', block : 'h3'},
                        {title : 'h4', block : 'h4'},
                        {title : 'h5', block : 'h5'},
                        {title : 'h6', block : 'h6'},
                        {title : 'p', block : 'p'},
                        {title : 'div', block : 'div'},
                        {title : 'pre', block : 'pre'},
                        {title : 'section', block : 'section', wrapper: true, merge_siblings: false},
                        {title : 'article', block : 'article', wrapper: true, merge_siblings: false},
                        {title : 'blockquote', block : 'blockquote', wrapper: true},
                        {title : 'hgroup', block : 'hgroup', wrapper: true},
                        {title : 'aside', block : 'aside', wrapper: true},
                        {title : 'figure', block : 'figure', wrapper: true}
                ]",
        		*/
	       // --------------------------------
		
			
	//		'theme_advanced_statusbar_location'	=> 'bottom',
			'theme_advanced_resizing'			=> 'true',
			'remove_linebreaks'					=> 'false',
			'extended_valid_elements'			=> vartrue($config['extended_valid_elements']), 
	//		'pagebreak_separator'				=> "[newpage]", 
			'apply_source_formatting'			=> 'true',
			'invalid_elements'					=> 'font,align,script,applet',
			'auto_cleanup_word'					=> 'true',
			'cleanup'							=> 'true',
			'convert_fonts_to_spans'			=> 'true',
			'content_css'						=> $tp->replaceConstants($content_css),
			'popup_css'							=> 'false', 
			
			'trim_span_elements'				=> 'true',
			'inline_styles'						=> 'true',
			'auto_resize'						=> 'false',
			'debug'								=> 'false',
			'force_br_newlines'					=> 'true',
			'media_strict'						=> 'false',
			'width'								=> vartrue($config['width'],'100%'),
		//	'height'							=> '90%', // higher causes padding at the top?
			'forced_root_block'					=> 'false', //remain as false or it will mess up some theme layouts. 
		
			'convert_newlines_to_brs'			=> 'true', // will break [list] if set to true
		//	'force_p_newlines'					=> 'false',
			'entity_encoding'					=> 'raw',
			'convert_fonts_to_styles'			=> 'true',
			'remove_script_host'				=> 'true',
			'relative_urls'						=> 'false', //Media Manager prefers it like this. 
			'preformatted'						=> 'true',
			'document_base_url'					=> SITEURL,
			'verify_css_classes'				=> 'false'

		);

	//	if(!in_array('e107bbcode',$plug_array))
		{
			$this->config['cleanup_callback'] = 'tinymce_e107Paths';										
		}

		$paste_plugin = (strpos($config['tinymce_plugins'],'paste')!==FALSE) ? TRUE : FALSE;

		if($paste_plugin)
		{
			$this->config += array(

				'paste_text_sticky'						=> 'true',
				'paste_text_sticky_default'				=> 'true',
				'paste_text_linebreaktype'				=> 'br',
		
				'remove_linebreaks'						=> 'false', // remove line break stripping by tinyMCE so that we can read the HTML
 				'paste_create_paragraphs'				=> 'false',	// for paste plugin - double linefeeds are converted to paragraph elements
 				'paste_create_linebreaks'				=> 'true',	// for paste plugin - single linefeeds are converted to hard line break elements
 				'paste_use_dialog'						=> 'true',	// for paste plugin - Mozilla and MSIE will present a paste dialog if true
 				'paste_auto_cleanup_on_paste'			=> 'true',	// for paste plugin - word paste will be executed when the user copy/paste content
 				'paste_convert_middot_lists'			=> 'false',	// for paste plugin - middot lists are converted into UL lists
 				'paste_unindented_list_class'			=> 'unindentedList', // for paste plugin - specify what class to assign to the UL list of middot cl's
 				'paste_convert_headers_to_strong'		=> 'true',	// for paste plugin - converts H1-6 elements to strong elements on paste
 				'paste_insert_word_content_callback'	=> 'convertWord', // for paste plugin - This callback is executed when the user pastes word content
				'auto_cleanup_word'						=> 'true'	// auto clean pastes from Word
			);
		}

		if(ADMIN)
		{
			$this->config['external_link_list_url'] = e_PLUGIN_ABS."tiny_mce/filelist.php";
		}
	}


	function filter_plugins($plugs)
	{

		$smile_pref = e107::getConfig()->getPref('smiley_activate');

		$admin_only = array("ibrowser");

		$plug_array = explode(",",$plugs);

		foreach($plug_array as $val)
		{
			if(in_array($val,$admin_only) && !ADMIN)
			{
		    	continue;
			}

			if(!$smile_pref && ($val=="emoticons"))
			{
		    	continue;
			}

			$tinymce_plugins[] = $val;
		}

		return implode(",",$tinymce_plugins);
	}


	function render()
	{
		echo $this->js;
	}
}

?>