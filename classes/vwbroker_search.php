<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Page class
 */
class vwbroker_search extends vwbroker
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{004E2122-9CCA-46AA-835C-0778C5A080BC}";

	// Table name
	public $TableName = 'vwbroker';

	// Page object name
	public $PageObjName = "vwbroker_search";

	// Audit Trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

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
		if ($this->TableName)
			return $Language->phrase($this->PageID);
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
			if ($this->UseTokenInUrl)
				$this->_pageUrl .= "t=" . $this->TableVar . "&"; // Add page token
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

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header <> "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer <> "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
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

		// Parent constuctor
		parent::__construct();

		// Table object (vwbroker)
		if (!isset($GLOBALS["vwbroker"]) || get_class($GLOBALS["vwbroker"]) == PROJECT_NAMESPACE . "vwbroker") {
			$GLOBALS["vwbroker"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["vwbroker"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (tbl_user)
		if (!isset($GLOBALS['tbl_user']))
			$GLOBALS['tbl_user'] = new tbl_user();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'vwbroker');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = &$this->getConnection();

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
		global $EXPORT, $vwbroker;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($vwbroker);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "vwbrokerview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = array();
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = array();
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {

								//$url = FullUrl($fld->TableVar . "/" . API_FILE_ACTION . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))); // URL rewrite format
								$url = FullUrl(GetPageName(API_URL) . "?" . API_OBJECT_NAME . "=" . $fld->TableVar . "&" . API_ACTION_NAME . "=" . API_FILE_ACTION . "&" . API_FIELD_NAME . "=" . $fld->Param . "&" . API_KEY_NAME . "=" . rawurlencode($this->getRecordKeyValue($ar))); // Query string format
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, MULTIPLE_UPLOAD_SEPARATOR)) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['ID_Order'] . $COMPOSITE_KEY_SEPARATOR;
			$key .= @$ar['Code'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAddOrEdit())
			$this->OrderID->Visible = FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-search-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$SearchError, $SkipHeaderFooter;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

		// Is modal
		$this->IsModal = (Param("modal") == "1");

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
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canSearch()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("vwbrokerlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->OrderID->setVisibility();
		$this->ID_Order->setVisibility();
		$this->CodeContact->setVisibility();
		$this->CompanyName->setVisibility();
		$this->Address->setVisibility();
		$this->TypeName->setVisibility();
		$this->Code->setVisibility();
		$this->ProductName->setVisibility();
		$this->Model->setVisibility();
		$this->PCS->setVisibility();
		$this->CreateDate->setVisibility();
		$this->OrderDate->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

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

		// Set up lookup cache
		$this->setupLookupOptions($this->TypeName);

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		if ($this->isPageRequest()) { // Validate request

			// Get action
			$this->CurrentAction = Post("action");
			if ($this->isSearch()) {

				// Build search string for advanced search, remove blank field
				$this->loadSearchValues(); // Get search values
				if ($this->validateSearch()) {
					$srchStr = $this->buildAdvancedSearch();
				} else {
					$srchStr = "";
					$this->setFailureMessage($SearchError);
				}
				if ($srchStr <> "") {
					$srchStr = $this->getUrlParm($srchStr);
					$srchStr = "vwbrokerlist.php" . "?" . $srchStr;
					$this->terminate($srchStr); // Go to list page
				}
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Render row for search
		$this->RowType = ROWTYPE_SEARCH;
		$this->resetAttributes();
		$this->renderRow();
	}

	// Build advanced search
	protected function buildAdvancedSearch()
	{
		$srchUrl = "";
		$this->buildSearchUrl($srchUrl, $this->OrderID); // OrderID
		$this->buildSearchUrl($srchUrl, $this->ID_Order); // ID_Order
		$this->buildSearchUrl($srchUrl, $this->CodeContact); // CodeContact
		$this->buildSearchUrl($srchUrl, $this->CompanyName); // CompanyName
		$this->buildSearchUrl($srchUrl, $this->Address); // Address
		$this->buildSearchUrl($srchUrl, $this->TypeName); // TypeName
		$this->buildSearchUrl($srchUrl, $this->Code); // Code
		$this->buildSearchUrl($srchUrl, $this->ProductName); // ProductName
		$this->buildSearchUrl($srchUrl, $this->Model); // Model
		$this->buildSearchUrl($srchUrl, $this->PCS); // PCS
		$this->buildSearchUrl($srchUrl, $this->CreateDate); // CreateDate
		$this->buildSearchUrl($srchUrl, $this->OrderDate); // OrderDate
		if ($srchUrl <> "")
			$srchUrl .= "&";
		$srchUrl .= "cmd=search";
		return $srchUrl;
	}

	// Build search URL
	protected function buildSearchUrl(&$url, &$fld, $oprOnly = FALSE)
	{
		global $CurrentForm;
		$wrk = "";
		$fldParm = $fld->Param;
		$fldVal = $CurrentForm->getValue("x_$fldParm");
		$fldOpr = $CurrentForm->getValue("z_$fldParm");
		$fldCond = $CurrentForm->getValue("v_$fldParm");
		$fldVal2 = $CurrentForm->getValue("y_$fldParm");
		$fldOpr2 = $CurrentForm->getValue("w_$fldParm");
		if (is_array($fldVal))
			$fldVal = implode(",", $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(",", $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		$fldDataType = ($fld->IsVirtual) ? DATATYPE_STRING : $fld->DataType;
		if ($fldOpr == "BETWEEN") {
			$isValidValue = ($fldDataType <> DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal) && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal <> "" && $fldVal2 <> "" && $isValidValue) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			}
		} else {
			$isValidValue = ($fldDataType <> DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal));
			if ($fldVal <> "" && $isValidValue && IsValidOpr($fldOpr, $fldDataType)) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			} elseif ($fldOpr == "IS NULL" || $fldOpr == "IS NOT NULL" || ($fldOpr <> "" && $oprOnly && IsValidOpr($fldOpr, $fldDataType))) {
				$wrk = "z_" . $fldParm . "=" . urlencode($fldOpr);
			}
			$isValidValue = ($fldDataType <> DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal2 <> "" && $isValidValue && IsValidOpr($fldOpr2, $fldDataType)) {
				if ($wrk <> "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&w_" . $fldParm . "=" . urlencode($fldOpr2);
			} elseif ($fldOpr2 == "IS NULL" || $fldOpr2 == "IS NOT NULL" || ($fldOpr2 <> "" && $oprOnly && IsValidOpr($fldOpr2, $fldDataType))) {
				if ($wrk <> "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "w_" . $fldParm . "=" . urlencode($fldOpr2);
			}
		}
		if ($wrk <> "") {
			if ($url <> "")
				$url .= "&";
			$url .= $wrk;
		}
	}
	protected function searchValueIsNumeric($fld, $value)
	{
		if (IsFloatFormat($fld->Type))
			$value = ConvertToFloatString($value);
		return is_numeric($value);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{
		global $CurrentForm;

		// Load search values
		// OrderID

		if (!$this->isAddOrEdit())
			$this->OrderID->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_OrderID"));
		$this->OrderID->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_OrderID"));

		// ID_Order
		if (!$this->isAddOrEdit())
			$this->ID_Order->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_ID_Order"));
		$this->ID_Order->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_ID_Order"));

		// CodeContact
		if (!$this->isAddOrEdit())
			$this->CodeContact->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_CodeContact"));
		$this->CodeContact->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_CodeContact"));

		// CompanyName
		if (!$this->isAddOrEdit())
			$this->CompanyName->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_CompanyName"));
		$this->CompanyName->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_CompanyName"));

		// Address
		if (!$this->isAddOrEdit())
			$this->Address->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_Address"));
		$this->Address->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_Address"));

		// TypeName
		if (!$this->isAddOrEdit())
			$this->TypeName->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_TypeName"));
		$this->TypeName->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_TypeName"));

		// Code
		if (!$this->isAddOrEdit())
			$this->Code->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_Code"));
		$this->Code->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_Code"));

		// ProductName
		if (!$this->isAddOrEdit())
			$this->ProductName->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_ProductName"));
		$this->ProductName->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_ProductName"));

		// Model
		if (!$this->isAddOrEdit())
			$this->Model->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_Model"));
		$this->Model->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_Model"));

		// PCS
		if (!$this->isAddOrEdit())
			$this->PCS->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_PCS"));
		$this->PCS->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_PCS"));

		// CreateDate
		if (!$this->isAddOrEdit())
			$this->CreateDate->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_CreateDate"));
		$this->CreateDate->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_CreateDate"));
		$this->CreateDate->AdvancedSearch->setSearchCondition($CurrentForm->getValue("v_CreateDate"));
		$this->CreateDate->AdvancedSearch->setSearchValue2($CurrentForm->getValue("y_CreateDate"));
		$this->CreateDate->AdvancedSearch->setSearchOperator2($CurrentForm->getValue("w_CreateDate"));

		// OrderDate
		if (!$this->isAddOrEdit())
			$this->OrderDate->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_OrderDate"));
		$this->OrderDate->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_OrderDate"));
		$this->OrderDate->AdvancedSearch->setSearchCondition($CurrentForm->getValue("v_OrderDate"));
		$this->OrderDate->AdvancedSearch->setSearchValue2($CurrentForm->getValue("y_OrderDate"));
		$this->OrderDate->AdvancedSearch->setSearchOperator2($CurrentForm->getValue("w_OrderDate"));
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// OrderID
		// ID_Order
		// CodeContact
		// CompanyName
		// Address
		// TypeName
		// Code
		// ProductName
		// Model
		// PCS
		// CreateDate
		// OrderDate

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// OrderID
			$this->OrderID->ViewValue = $this->OrderID->CurrentValue;
			$this->OrderID->ViewCustomAttributes = "";

			// ID_Order
			$this->ID_Order->ViewValue = $this->ID_Order->CurrentValue;
			$this->ID_Order->CellCssStyle .= "text-align: center;";
			$this->ID_Order->ViewCustomAttributes = "";

			// CodeContact
			$this->CodeContact->ViewValue = $this->CodeContact->CurrentValue;
			$this->CodeContact->CellCssStyle .= "text-align: center;";
			$this->CodeContact->ViewCustomAttributes = "";

			// CompanyName
			$this->CompanyName->ViewValue = $this->CompanyName->CurrentValue;
			$this->CompanyName->ViewCustomAttributes = "";

			// Address
			$this->Address->ViewValue = $this->Address->CurrentValue;
			$this->Address->ViewCustomAttributes = "";

			// TypeName
			$arwrk = array();
			$arwrk[1] = $this->TypeName->CurrentValue;
			$this->TypeName->ViewValue = $this->TypeName->displayValue($arwrk);
			$this->TypeName->CellCssStyle .= "text-align: center;";
			$this->TypeName->ViewCustomAttributes = "";

			// Code
			$this->Code->ViewValue = $this->Code->CurrentValue;
			$this->Code->ViewCustomAttributes = "";

			// ProductName
			$this->ProductName->ViewValue = $this->ProductName->CurrentValue;
			$this->ProductName->ViewCustomAttributes = "";

			// Model
			$this->Model->ViewValue = $this->Model->CurrentValue;
			$this->Model->ViewCustomAttributes = "";

			// PCS
			$this->PCS->ViewValue = $this->PCS->CurrentValue;
			$this->PCS->ViewValue = FormatNumber($this->PCS->ViewValue, 0, -2, -2, -2);
			$this->PCS->CellCssStyle .= "text-align: right;";
			$this->PCS->ViewCustomAttributes = "";

			// CreateDate
			$this->CreateDate->ViewValue = $this->CreateDate->CurrentValue;
			$this->CreateDate->ViewValue = FormatDateTime($this->CreateDate->ViewValue, 11);
			$this->CreateDate->CellCssStyle .= "text-align: center;";
			$this->CreateDate->ViewCustomAttributes = "";

			// OrderDate
			$this->OrderDate->ViewValue = $this->OrderDate->CurrentValue;
			$this->OrderDate->ViewValue = FormatDateTime($this->OrderDate->ViewValue, 1);
			$this->OrderDate->ViewCustomAttributes = "";

			// OrderID
			$this->OrderID->LinkCustomAttributes = "";
			$this->OrderID->HrefValue = "";
			$this->OrderID->TooltipValue = "";

			// ID_Order
			$this->ID_Order->LinkCustomAttributes = "";
			$this->ID_Order->HrefValue = "";
			$this->ID_Order->TooltipValue = "";

			// CodeContact
			$this->CodeContact->LinkCustomAttributes = "";
			$this->CodeContact->HrefValue = "";
			$this->CodeContact->TooltipValue = "";

			// CompanyName
			$this->CompanyName->LinkCustomAttributes = "";
			$this->CompanyName->HrefValue = "";
			$this->CompanyName->TooltipValue = "";

			// Address
			$this->Address->LinkCustomAttributes = "";
			$this->Address->HrefValue = "";
			$this->Address->TooltipValue = "";

			// TypeName
			$this->TypeName->LinkCustomAttributes = "";
			$this->TypeName->HrefValue = "";
			$this->TypeName->TooltipValue = "";

			// Code
			$this->Code->LinkCustomAttributes = "";
			$this->Code->HrefValue = "";
			$this->Code->TooltipValue = "";

			// ProductName
			$this->ProductName->LinkCustomAttributes = "";
			$this->ProductName->HrefValue = "";
			$this->ProductName->TooltipValue = "";

			// Model
			$this->Model->LinkCustomAttributes = "";
			$this->Model->HrefValue = "";
			$this->Model->TooltipValue = "";

			// PCS
			$this->PCS->LinkCustomAttributes = "";
			$this->PCS->HrefValue = "";
			$this->PCS->TooltipValue = "";

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";
			$this->CreateDate->TooltipValue = "";

			// OrderDate
			$this->OrderDate->LinkCustomAttributes = "";
			$this->OrderDate->HrefValue = "";
			$this->OrderDate->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// OrderID
			$this->OrderID->EditAttrs["class"] = "form-control";
			$this->OrderID->EditCustomAttributes = "";
			$this->OrderID->EditValue = HtmlEncode($this->OrderID->AdvancedSearch->SearchValue);
			$this->OrderID->PlaceHolder = RemoveHtml($this->OrderID->caption());

			// ID_Order
			$this->ID_Order->EditAttrs["class"] = "form-control";
			$this->ID_Order->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->ID_Order->AdvancedSearch->SearchValue = HtmlDecode($this->ID_Order->AdvancedSearch->SearchValue);
			$this->ID_Order->EditValue = HtmlEncode($this->ID_Order->AdvancedSearch->SearchValue);
			$this->ID_Order->PlaceHolder = RemoveHtml($this->ID_Order->caption());

			// CodeContact
			$this->CodeContact->EditAttrs["class"] = "form-control";
			$this->CodeContact->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->CodeContact->AdvancedSearch->SearchValue = HtmlDecode($this->CodeContact->AdvancedSearch->SearchValue);
			$this->CodeContact->EditValue = HtmlEncode($this->CodeContact->AdvancedSearch->SearchValue);
			$this->CodeContact->PlaceHolder = RemoveHtml($this->CodeContact->caption());

			// CompanyName
			$this->CompanyName->EditAttrs["class"] = "form-control";
			$this->CompanyName->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->CompanyName->AdvancedSearch->SearchValue = HtmlDecode($this->CompanyName->AdvancedSearch->SearchValue);
			$this->CompanyName->EditValue = HtmlEncode($this->CompanyName->AdvancedSearch->SearchValue);
			$this->CompanyName->PlaceHolder = RemoveHtml($this->CompanyName->caption());

			// Address
			$this->Address->EditAttrs["class"] = "form-control";
			$this->Address->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Address->AdvancedSearch->SearchValue = HtmlDecode($this->Address->AdvancedSearch->SearchValue);
			$this->Address->EditValue = HtmlEncode($this->Address->AdvancedSearch->SearchValue);
			$this->Address->PlaceHolder = RemoveHtml($this->Address->caption());

			// TypeName
			$this->TypeName->EditAttrs["class"] = "form-control";
			$this->TypeName->EditCustomAttributes = "";
			$curVal = trim(strval($this->TypeName->AdvancedSearch->SearchValue));
			if ($curVal <> "")
				$this->TypeName->AdvancedSearch->ViewValue = $this->TypeName->lookupCacheOption($curVal);
			else
				$this->TypeName->AdvancedSearch->ViewValue = $this->TypeName->Lookup !== NULL && is_array($this->TypeName->Lookup->Options) ? $curVal : NULL;
			if ($this->TypeName->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->TypeName->EditValue = array_values($this->TypeName->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`TypeName`" . SearchString("=", $this->TypeName->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->TypeName->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->TypeName->EditValue = $arwrk;
			}

			// Code
			$this->Code->EditAttrs["class"] = "form-control";
			$this->Code->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Code->AdvancedSearch->SearchValue = HtmlDecode($this->Code->AdvancedSearch->SearchValue);
			$this->Code->EditValue = HtmlEncode($this->Code->AdvancedSearch->SearchValue);
			$this->Code->PlaceHolder = RemoveHtml($this->Code->caption());

			// ProductName
			$this->ProductName->EditAttrs["class"] = "form-control";
			$this->ProductName->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->ProductName->AdvancedSearch->SearchValue = HtmlDecode($this->ProductName->AdvancedSearch->SearchValue);
			$this->ProductName->EditValue = HtmlEncode($this->ProductName->AdvancedSearch->SearchValue);
			$this->ProductName->PlaceHolder = RemoveHtml($this->ProductName->caption());

			// Model
			$this->Model->EditAttrs["class"] = "form-control";
			$this->Model->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Model->AdvancedSearch->SearchValue = HtmlDecode($this->Model->AdvancedSearch->SearchValue);
			$this->Model->EditValue = HtmlEncode($this->Model->AdvancedSearch->SearchValue);
			$this->Model->PlaceHolder = RemoveHtml($this->Model->caption());

			// PCS
			$this->PCS->EditAttrs["class"] = "form-control";
			$this->PCS->EditCustomAttributes = "";
			$this->PCS->EditValue = HtmlEncode($this->PCS->AdvancedSearch->SearchValue);
			$this->PCS->PlaceHolder = RemoveHtml($this->PCS->caption());

			// CreateDate
			$this->CreateDate->EditAttrs["class"] = "form-control";
			$this->CreateDate->EditCustomAttributes = "";
			$this->CreateDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->CreateDate->AdvancedSearch->SearchValue, 11), 11));
			$this->CreateDate->PlaceHolder = RemoveHtml($this->CreateDate->caption());
			$this->CreateDate->EditAttrs["class"] = "form-control";
			$this->CreateDate->EditCustomAttributes = "";
			$this->CreateDate->EditValue2 = HtmlEncode(FormatDateTime(UnFormatDateTime($this->CreateDate->AdvancedSearch->SearchValue2, 11), 11));
			$this->CreateDate->PlaceHolder = RemoveHtml($this->CreateDate->caption());

			// OrderDate
			$this->OrderDate->EditAttrs["class"] = "form-control";
			$this->OrderDate->EditCustomAttributes = "";
			$this->OrderDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->OrderDate->AdvancedSearch->SearchValue, 1), 8));
			$this->OrderDate->PlaceHolder = RemoveHtml($this->OrderDate->caption());
			$this->OrderDate->EditAttrs["class"] = "form-control";
			$this->OrderDate->EditCustomAttributes = "";
			$this->OrderDate->EditValue2 = HtmlEncode(FormatDateTime(UnFormatDateTime($this->OrderDate->AdvancedSearch->SearchValue2, 1), 8));
			$this->OrderDate->PlaceHolder = RemoveHtml($this->OrderDate->caption());
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	protected function validateSearch()
	{
		global $SearchError;

		// Initialize
		$SearchError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return TRUE;
		if (!CheckInteger($this->OrderID->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->OrderID->errorMessage());
		}
		if (!CheckInteger($this->ID_Order->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ID_Order->errorMessage());
		}
		if (!CheckInteger($this->PCS->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->PCS->errorMessage());
		}
		if (!CheckEuroDate($this->CreateDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->CreateDate->errorMessage());
		}
		if (!CheckEuroDate($this->CreateDate->AdvancedSearch->SearchValue2)) {
			AddMessage($SearchError, $this->CreateDate->errorMessage());
		}
		if (!CheckDate($this->OrderDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->OrderDate->errorMessage());
		}
		if (!CheckDate($this->OrderDate->AdvancedSearch->SearchValue2)) {
			AddMessage($SearchError, $this->OrderDate->errorMessage());
		}

		// Return validate result
		$validateSearch = ($SearchError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateSearch = $validateSearch && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($SearchError, $formCustomError);
		}
		return $validateSearch;
	}

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->OrderID->AdvancedSearch->load();
		$this->ID_Order->AdvancedSearch->load();
		$this->CodeContact->AdvancedSearch->load();
		$this->CompanyName->AdvancedSearch->load();
		$this->Address->AdvancedSearch->load();
		$this->TypeName->AdvancedSearch->load();
		$this->Code->AdvancedSearch->load();
		$this->ProductName->AdvancedSearch->load();
		$this->Model->AdvancedSearch->load();
		$this->PCS->AdvancedSearch->load();
		$this->CreateDate->AdvancedSearch->load();
		$this->OrderDate->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("vwbrokerlist.php"), "", $this->TableVar, TRUE);
		$pageId = "search";
		$Breadcrumb->add("search", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->ParentFields) == 0 && count($fld->Lookup->Options) == 0) {
				$conn = &$this->getConnection();
				$totalCnt = $this->getRecordCount($sql);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_TypeName":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
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
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>