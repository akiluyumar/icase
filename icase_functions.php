<?php
/*Generate LOVs*/

//$lst_states = get_states();
// $lst_lgas = get_lgas();
//$lst_courts = get_courtss();
//$lst_detention = get_detention();
//$lst_offence_cat = get_offences();
//$lst_status = get_detention_status();
//$fltr_lgas = get_lgas4state ($this_state);

/*End Generate LOVs*/

// GET LIST - (Organisations) 
	function get_orgs () {
		global $conn;
		$query = "SELECT * from tbl_orgs ";
		$result_set = mysqli_query($conn, $query);
		// confirm_query($result_set);
		return $result_set;
	}
// GET LIST - (Teams) 
	function get_teams () {
		global $conn;
		$query = "SELECT * from tbl_teams ";
		$result_set = mysqli_query($conn, $query);
		// confirm_query($result_set);
		return $result_set;
	}
// GET LIST - (Teams for specific Org) 
	function get_teams4org ($this_org) {
		global $conn;
		$query = "SELECT * from tbl_teams where org_id = '$this_org'";
		$result_set = mysqli_query($conn, $query);
		// confirm_query($result_set);
		return $result_set;
	}
// GET LIST - (STATES) 
	function get_states() {
		global $conn;
		$query = "SELECT * from tbl_states ";
		$result_set = mysqli_query($conn, $query);
		// confirm_query($result_set);
		return $result_set;
	}
// GET LIST - (LGAS) 
	function get_lgas () {
		global $conn;
		$query = "SELECT * from tbl_lgas WHERE state='$state'";
		$result_set = mysqli_query($conn, $query);
		// confirm_query($result_set);
		return $result_set;
	}
// GET LIST (LGAS for specified state) 
	function get_lgas4state ($this_state) {
		global $conn;
		$query = "SELECT a.* from tbl_lgas a where a.state = '$this_state' ";
		$result_set = mysqli_query($conn, $query);
		// confirm_query($result_set);
		return $result_set;
	}
// GET COURTS 
	function get_courts () {
		global $conn;
		$query = "SELECT * from tbl_courts ";
		$result_set = mysqli_query($conn, $query);
		// confirm_query($result_set);
		return $result_set;
	}

	// GET SUSPECTS - (SPECIFIC CRNO) 
	function get_suspect ($fk_crno) {
		$records = !isset($limit_size)? '': " LIMIT ".$limit_size;
		global $conn;
		$query = "SELECT * from tbl_suspects ";
		$query .= "where susp_id IN (select susp_id from tbl_arrests " ;
		$query .= "where crno = '$fk_crno') " . $records ;
		$result_set = mysqli_query($conn, $query);
		confirm_query($result_set);
		return $result_set;

	}
	function getstr_suspectlst($fk_crno){
		// Query string to retrieve list of suspects for current case diary
		global $conn;
		$query = "SELECT * from tbl_suspects ";
		$query .= " where susp_id IN (select susp_id from tbl_arrests " ;
		$query .= " where crno = '$fk_crno') " ;
		return $query;
		
	}
	function getstr_inmateslst(){
		// Query string to retrieve list of suspects for current case diary
		global $conn; global $row;
		$query = "SELECT * FROM tbl_prisoners order by date_reg DESC ";
		return $query;
		
	}
	function get_inmates_by_gender (){	// Summary of Prisoners by Gender
		global $conn; global $row;
		$query = "SELECT gender, count(gender) as no FROM tbl_prisoners group by gender";
		return $query;
		
	}
	function get_inmates_by_mstatus (){	// Summary of Prisoners by Marital Status
		global $conn;
		$query = "SELECT marital_status as 'Marital Status', count(marital_status) as count FROM tbl_prisoners group by marital_status";
		return $query;
		
	}
	function get_inmates_by_religion (){ // Summary of Prisoners by Faith
		global $conn;
		$query = "SELECT religion, count(religion) as religion FROM tbl_prisoners group by religion";
		return $query;
		
	}
// GET ARRESTS - (SPECIFIC CRNO) 
	function get_arrests ($fk_crno) {
		$records = !isset($limit_size)? '': " LIMIT ".$limit_size;
		global $conn;
		$query = "SELECT * from tbl_arrests ";
		$query .= "where crno = '$fk_crno' " . $records ;
		$result_set = mysqli_query($conn, $query);
		confirm_query($result_set);
		return $result_set;

	}
// GET SUSPECTS AND ARRESTS - (SPECIFIC CRNO) 
	function get_suspect_arrests ($fk_crno) {
		$records = !isset($limit_size)? '': " LIMIT ".$limit_size;
		global $conn;
		$query = "SELECT a.*, b.arrest_date, b.arrest_story, b.arr_location, arr_state, b.team, b.remarks, b.arr_time ";
		$query .= "where susp_id = (select susp_id from tbl_arrests " ;
		$query .= "from tbl_suspects a, tbl_arrests b " ;
		$query .= "where b.crno = '$fk_crno' and a.susp_id = b.susp_id " . $records ;
		$result_set = mysqli_query($conn, $query);
		confirm_query($result_set);
		return $result_set;

	}


function get_user($username,$password) {

    global $conn;

    $query = "SELECT a.*, b.group_name, b.can_add, b.can_edit, b.can_del, b.can_view, ";
    $query .= "b.training_mod, b.research_mod, b.general_mod, b.extras_mod, b.users_mod, ";
    $query .= "b.other_mod1, b.other_mod2 ";
    $query .= "FROM efccacad.tbl_user_accts a INNER JOIN efccacad.tbl_user_grp b on a.group_id=b.group_id ";
    $query .= "WHERE a.username='$username' AND a.password='$password'" ;

    $result = mysqli_query($conn. $query);
    
    return $result;

}
	
	function rset_session()
	{
		session_destroy();

		//		Reset User Session

		$_SESSION['crno'] = '';
		$_SESSION['group_id'] = '';
		$_SESSION['username'] = '';
		$_SESSION['group_name'] = '';
		$_SESSION['email'] = '';
		$_SESSION['gsm'] = '';
		
		$_SESSION['can_add'] = 0;		// Can add records
		$_SESSION['can_upd'] = 0;		// Can update records
		$_SESSION['can_del'] = 0;		// Can delete records
		$_SESSION['can_adm'] = 0;		// Can Administer
		
		// other environment settings
		$_SESSION['rs_limit'] = 20; 		// default number of records to return from a query

		// Navigation Control Variables
		$_SESSION['crud_mod'] = ''; // Crud_mod (possible values are 1=ADD; 2=VIEW; 3=EDIT; 4=DELETE
		$_SESSION['modl'] = ''; // Modl (possible values are "New Record"; "Record Update"
		$_SESSION['modldesc'] = ''; // Modl description
		$_SESSION['pgHeading'] = ''; // Page Heading
		$_SESSION['can_apprv'] = 0;		// Can Approve
		
	}
	
	function rset_admin_session()
	{
		// Current USer Access Control (to be used in the Admin Area - i.e. 'User Privileges', 'User Accounts')
		$_SESSION['adm_user_id'] = '';
		$_SESSION['adm_group_id'] = '';
		$_SESSION['adm_username'] = '';
		$_SESSION['adm_password'] = '';
		$_SESSION['adm_group_name'] = '';
		$_SESSION['adm_group_desc'] = '';
		$_SESSION['adm_fullname'] = '';
		$_SESSION['adm_email'] = '';
		$_SESSION['adm_gsm'] = '';
		$_SESSION['adm_secret_quest'] = '';
		$_SESSION['adm_secret_answer'] = '';
		$_SESSION['adm_designation'] = '';
		$_SESSION['adm_surname'] = '';
		$_SESSION['adm_othernames'] = '';
		$_SESSION['adm_fileno'] = '';

		$_SESSION['adm_can_add'] = 0;		// Can add records
		$_SESSION['adm_can_upd'] = 0;		// Can update records
		$_SESSION['adm_can_del'] = 0;		// Can delete records
		$_SESSION['adm_can_adm'] = 0;		// Can Administer
		$_SESSION['adm_can_apprv'] = 0;		// Can Approve
		
	}

	function init_ckeditor () {
		// CKEDITOR Editing tool
	  // Make sure you are using a correct path here. 
	  // include_once 'ckeditor/ckeditor.php';  
	  $ckeditor = new CKEditor(); 
	  $ckeditor->basePath = '/ckeditor/'; 
	  $ckeditor->config['filebrowserBrowseUrl'] = 'ckfinder/ckfinder.html'; 
	  $ckeditor->config['filebrowserImageBrowseUrl'] = 'ckfinder/ckfinder.html?type=Images'; 
	  $ckeditor->config['filebrowserFlashBrowseUrl'] = 'ckfinder/ckfinder.html?type=Flash'; 
	  $ckeditor->config['filebrowserUploadUrl'] = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'; 
	  $ckeditor->config['filebrowserImageUploadUrl'] = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	  $ckeditor->config['filebrowserFlashUploadUrl'] = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'; 
	  $ckeditor->editor('CKEditor1');  
	}

//Get Module by type
function get_modl($module, $module_id) {
    global $conn;
    
    if($module == "POLICE") {
        $query = "SELECT org_name as name, org_state as state FROM tbl_orgs WHERE org_id='$module_id'";
    } else if($module == "COURT") {
        $query = "SELECT court_name as name, court_state as state FROM tbl_courts WHERE court_id='$module_id'";
    } else if($module == "MINISTRY") {
        $query = "SELECT moj_name as name, moj_state as state FROM tbl_moj WHERE moj_id='$module_id'";
    } else if($module == "PRISON") {
        $query = "SELECT prison_name as name, prison_state as state FROM tbl_prisons WHERE prison_id='$module_id'";
    }
    
    $result = mysqli_query($conn, $query);
    $rows = mysqli_fetch_assoc($result);
    
    return $rows;
}

//List Select Offence Category
function get_offence_category() {
    //Get DB Connect Link
    global $conn;
    
    //Mysqli Query
    $query = "SELECT * FROM tbl_offence_category";
    //Mysqli Result
    $result = mysqli_query($conn, $query);
    
    //Rows
    //$rows = mysqli_fetch_assoc($result);
    
    //Returns
    //return $rows;
    return $result;
}

//Get Detention Status
function get_detention_status() {
    global $conn;
    
    $query = "SELECT * FROM tbl_detention_status";
    $result = mysqli_query($conn, $query);
    
    return $result;
}

//Get Prisons
function get_prisons() {
    global $conn;
    
    $query = "SELECT * FROM tbl_prisons";
    $result = mysqli_query($conn, $query);
    
    return $result;
}

//Get Specific Prison
function get_prison($index) {
    global $conn;
    
    $query = "SELECT * FROM tbl_prisons WHERE prison_id='$index'";
    $result = mysqli_query($conn, $query);
    
    return $result;
}

//Check Value
function check_value($fn, $value) {
    return ($result = mysqli_fetch_assoc($fn($value))) ?  $result : "None";
}

//Get / List all Warders
function get_warders() {
    global $conn;
    
    $query = "SELECT * FROM tbl_warders";
    $result = mysqli_query($conn, $query);
    
    return $result;
}
?>