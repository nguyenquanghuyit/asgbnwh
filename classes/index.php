<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Page class
 */
class index
{

	// Page ID
	public $PageID = "index";

	// Project ID
	public $ProjectID = "{004E2122-9CCA-46AA-835C-0778C5A080BC}";

	// Page object name
	public $PageObjName = "index";

	// Page headings
	public $Heading = "";
	public $Subheading = "";

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken = CHECK_TOKEN;

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Page URL
	private $_pageUrl = "";

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		if ($this->_pageUrl == "") {
			$this->_pageUrl = CurrentPageName() . "?";
		}
		return $this->_pageUrl;
	}

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message <> "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fa fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fa fa-warning"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage <> "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fa fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fa fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = array();

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message <> "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage <> "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage <> "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage <> "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(TOKEN_NAME) === NULL)
			return FALSE;
		$fn = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
		if (is_callable($fn))
			return $fn(Post(TOKEN_NAME), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = PROJECT_NAMESPACE . CREATE_TOKEN_FUNC; // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $COMPOSITE_KEY_SEPARATOR;
		global $UserTable, $UserTableConn;

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'index');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = &GetConnection();

		// User table object (tbl_user)
		if (!isset($UserTable)) {
			$UserTable = new tbl_user();
			$UserTableConn = Conn($UserTable->Dbid);
		}
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url <> "") {
			if (!DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			SaveDebugMessage();
			AddHeader("Location", $url);
		}
		exit();
	}

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$Breadcrumb;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

		// User profile
		$UserProfile = new UserProfile();

		// Security
		$Security = new AdvancedSecurity();
		$validRequest = FALSE;

		// Check security for API request
		If (IsApi()) {

			// Check token first
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Post(TOKEN_NAME) !== NULL)
				$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			elseif (is_array($RequestSecurity) && @$RequestSecurity["username"] <> "") // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
		}
		if (!$validRequest) {
		}

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();
		$Breadcrumb = new Breadcrumb();

		// If session expired, show session expired message
		if (Get("expired") == "1")
			$this->setFailureMessage($Language->phrase("SessionExpired"));
		if (!$Security->isLoggedIn())
			$Security->autoLogin();
		$Security->loadUserLevel(); // Load User Level
		if ($Security->allowList(CurrentProjectID() . 'tbl_stock'))
			$this->terminate("tbl_stocklist.php"); // Exit and go to default page
		if ($Security->allowList(CurrentProjectID() . 'tbl_contact'))
			$this->terminate("tbl_contactlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_history'))
			$this->terminate("tbl_historylist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_location'))
			$this->terminate("tbl_locationlist.php");
		if ($Security->allowList(CurrentProjectID() . 'nhanvien'))
			$this->terminate("nhanvienlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_order'))
			$this->terminate("tbl_orderlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_orderdetail'))
			$this->terminate("tbl_orderdetaillist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_orderguide'))
			$this->terminate("tbl_orderguidelist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_pallet'))
			$this->terminate("tbl_palletlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_product'))
			$this->terminate("tbl_productlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_route'))
			$this->terminate("tbl_routelist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_unload'))
			$this->terminate("tbl_unloadlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_user'))
			$this->terminate("tbl_userlist.php");
		if ($Security->allowList(CurrentProjectID() . 'userlevelpermissions'))
			$this->terminate("userlevelpermissionslist.php");
		if ($Security->allowList(CurrentProjectID() . 'userlevels'))
			$this->terminate("userlevelslist.php");
		if ($Security->allowList(CurrentProjectID() . 'phongban'))
			$this->terminate("phongbanlist.php");
		if ($Security->allowList(CurrentProjectID() . 'todoi'))
			$this->terminate("todoilist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_guider'))
			$this->terminate("tbl_guiderlist.php");
		if ($Security->allowList(CurrentProjectID() . 'vwmasterguide'))
			$this->terminate("vwmasterguidelist.php");
		if ($Security->allowList(CurrentProjectID() . 'vwcodeinstock'))
			$this->terminate("vwcodeinstocklist.php");
		if ($Security->allowList(CurrentProjectID() . 'vwguidepicking'))
			$this->terminate("vwguidepickinglist.php");
		if ($Security->allowList(CurrentProjectID() . 'vt_order'))
			$this->terminate("vt_orderlist.php");
		if ($Security->allowList(CurrentProjectID() . 'vt_orderguide'))
			$this->terminate("vt_orderguidelist.php");
		if ($Security->allowList(CurrentProjectID() . 'vwhistoryorder'))
			$this->terminate("vwhistoryorderlist.php");
		if ($Security->allowList(CurrentProjectID() . 'vwpickingbyorder'))
			$this->terminate("vwpickingbyorderlist.php");
		if ($Security->allowList(CurrentProjectID() . 'vworderdetail'))
			$this->terminate("vworderdetaillist.php");
		if ($Security->allowList(CurrentProjectID() . 'vwrouteout'))
			$this->terminate("vwrouteoutlist.php");
		if ($Security->allowList(CurrentProjectID() . 'vwinboudsumary'))
			$this->terminate("vwinboudsumarylist.php");
		if ($Security->allowList(CurrentProjectID() . 'vwcodesummary'))
			$this->terminate("vwcodesummarylist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_inventory'))
			$this->terminate("tbl_inventorylist.php");
		if ($Security->allowList(CurrentProjectID() . 'vwinventory'))
			$this->terminate("vwinventorylist.php");
		if ($Security->allowList(CurrentProjectID() . 'vwsumpcs_code'))
			$this->terminate("vwsumpcs_codelist.php");
		if ($Security->allowList(CurrentProjectID() . 'vwsumpcs_location'))
			$this->terminate("vwsumpcs_locationlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_loading'))
			$this->terminate("tbl_loadinglist.php");
		if ($Security->allowList(CurrentProjectID() . 'vwroutepending'))
			$this->terminate("vwroutependinglist.php");
		if ($Security->allowList(CurrentProjectID() . 'vwoutboudsumary'))
			$this->terminate("vwoutboudsumarylist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_checkstock'))
			$this->terminate("tbl_checkstocklist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_checkstockdetail'))
			$this->terminate("tbl_checkstockdetaillist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_history_pick'))
			$this->terminate("tbl_history_picklist.php");
		if ($Security->allowList(CurrentProjectID() . 'vworder_not_route'))
			$this->terminate("vworder_not_routelist.php");
		if ($Security->allowList(CurrentProjectID() . 'vwbroker'))
			$this->terminate("vwbrokerlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_goodsinpack'))
			$this->terminate("tbl_goodsinpacklist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_packing'))
			$this->terminate("tbl_packinglist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_packingdetail'))
			$this->terminate("tbl_packingdetaillist.php");
		if ($Security->allowList(CurrentProjectID() . 'vworder_packing'))
			$this->terminate("vworder_packinglist.php");
		if ($Security->allowList(CurrentProjectID() . 'packing'))
			$this->terminate("packinglist.php");
		if ($Security->allowList(CurrentProjectID() . 'audittrail'))
			$this->terminate("audittraillist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_unit'))
			$this->terminate("tbl_unitlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_product_detail'))
			$this->terminate("tbl_product_detaillist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_order_po_inv'))
			$this->terminate("tbl_order_po_invlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tbl_producttype'))
			$this->terminate("tbl_producttypelist.php");
		if ($Security->allowList(CurrentProjectID() . 'vwcode_type'))
			$this->terminate("vwcode_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'fox_inboudsumary'))
			$this->terminate("fox_inboudsumarylist.php");
		if ($Security->allowList(CurrentProjectID() . 'ina_inboudsumary'))
			$this->terminate("ina_inboudsumarylist.php");
		if ($Security->allowList(CurrentProjectID() . 'mitsu_inboudsumary'))
			$this->terminate("mitsu_inboudsumarylist.php");
		if ($Security->allowList(CurrentProjectID() . 'spica_inboudsumary'))
			$this->terminate("spica_inboudsumarylist.php");
		if ($Security->allowList(CurrentProjectID() . 'fox_outboudsumary'))
			$this->terminate("fox_outboudsumarylist.php");
		if ($Security->allowList(CurrentProjectID() . 'ina_outboudsumary'))
			$this->terminate("ina_outboudsumarylist.php");
		if ($Security->allowList(CurrentProjectID() . 'mitsu_outboudsumary'))
			$this->terminate("mitsu_outboudsumarylist.php");
		if ($Security->allowList(CurrentProjectID() . 'spica_outboudsumary'))
			$this->terminate("spica_outboudsumarylist.php");
		if ($Security->allowList(CurrentProjectID() . 'foxconn_sumbycode'))
			$this->terminate("foxconn_sumbycodelist.php");
		if ($Security->allowList(CurrentProjectID() . 'inabata_sumbycode'))
			$this->terminate("inabata_sumbycodelist.php");
		if ($Security->allowList(CurrentProjectID() . 'mitsubishi_sumbycode'))
			$this->terminate("mitsubishi_sumbycodelist.php");
		if ($Security->allowList(CurrentProjectID() . 'spica_sumbycode'))
			$this->terminate("spica_sumbycodelist.php");
		if ($Security->allowList(CurrentProjectID() . 'foxco_pcs_location'))
			$this->terminate("foxco_pcs_locationlist.php");
		if ($Security->allowList(CurrentProjectID() . 'ina_pcs_location'))
			$this->terminate("ina_pcs_locationlist.php");
		if ($Security->allowList(CurrentProjectID() . 'mitsu_pcs_location'))
			$this->terminate("mitsu_pcs_locationlist.php");
		if ($Security->allowList(CurrentProjectID() . 'spica_pcs_location'))
			$this->terminate("spica_pcs_locationlist.php");
		if ($Security->allowList(CurrentProjectID() . 'foxconninventory'))
			$this->terminate("foxconninventorylist.php");
		if ($Security->allowList(CurrentProjectID() . 'inabata_inventory'))
			$this->terminate("inabata_inventorylist.php");
		if ($Security->allowList(CurrentProjectID() . 'mitsubishi_inventory'))
			$this->terminate("mitsubishi_inventorylist.php");
		if ($Security->allowList(CurrentProjectID() . 'spica_inventory'))
			$this->terminate("spica_inventorylist.php");
		if ($Security->allowList(CurrentProjectID() . 'vwStock'))
			$this->terminate("vwStocklist.php");
		if ($Security->allowList(CurrentProjectID() . 'vwPackingdetail'))
			$this->terminate("vwPackingdetaillist.php");
		if ($Security->allowList(CurrentProjectID() . 'vwhistoryPicking'))
			$this->terminate("vwhistoryPickinglist.php");
		if ($Security->allowList(CurrentProjectID() . 'vwRouteUnload'))
			$this->terminate("vwRouteUnloadlist.php");
		if ($Security->isLoggedIn()) {
			$this->setFailureMessage(DeniedMessage() . "<br><br><a href=\"logout.php\">" . $Language->phrase("BackToLogin") . "</a>");
		} else {
			$this->terminate("login.php"); // Exit and go to login page
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}
}
?>