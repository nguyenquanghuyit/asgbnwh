<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Page class
 */
class tbl_route_list extends tbl_route
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{004E2122-9CCA-46AA-835C-0778C5A080BC}";

	// Table name
	public $TableName = 'tbl_route';

	// Page object name
	public $PageObjName = "tbl_route_list";

	// Grid form hidden field names
	public $FormName = "ftbl_routelist";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;
	public $CancelUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

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

		// Table object (tbl_route)
		if (!isset($GLOBALS["tbl_route"]) || get_class($GLOBALS["tbl_route"]) == PROJECT_NAMESPACE . "tbl_route") {
			$GLOBALS["tbl_route"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_route"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->AddUrl = "tbl_routeadd.php?" . TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "tbl_routedelete.php";
		$this->MultiUpdateUrl = "tbl_routeupdate.php";
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (tbl_user)
		if (!isset($GLOBALS['tbl_user']))
			$GLOBALS['tbl_user'] = new tbl_user();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_route');

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

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new ListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Import options
		$this->ImportOptions = new ListOptions();
		$this->ImportOptions->Tag = "div";
		$this->ImportOptions->TagClassName = "ew-import-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions();
		$this->OtherOptions["addedit"]->Tag = "div";
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
		$this->OtherOptions["detail"] = new ListOptions();
		$this->OtherOptions["detail"]->Tag = "div";
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
		$this->OtherOptions["action"] = new ListOptions();
		$this->OtherOptions["action"]->Tag = "div";
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";

		// Filter options
		$this->FilterOptions = new ListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ew-filter-option ftbl_routelistsrch";

		// List actions
		$this->ListActions = new ListActions();
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
		global $EXPORT, $tbl_route;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_route);
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
			SaveDebugMessage();
			AddHeader("Location", $url);
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
			$key .= @$ar['ID_Route'];
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
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->ID_Route->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->UpdateUser->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->UpdateDate->Visible = FALSE;
	}

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions; // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $DisplayRecs = 20;
	public $StartRec;
	public $StopRec;
	public $TotalRecs = 0;
	public $RecRange = 10;
	public $Pager;
	public $AutoHidePager = AUTO_HIDE_PAGER;
	public $AutoHidePageSizeSelector = AUTO_HIDE_PAGE_SIZE_SELECTOR;
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $RecCnt = 0; // Record count
	public $EditRowCnt;
	public $StartRowCnt = 1;
	public $RowCnt = 0;
	public $Attrs = array(); // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $vwRouteUnload_Count;
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SearchError, $EXPORT;

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
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canList()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Get export parameters
		$custom = "";
		if (Param("export") !== NULL) {
			$this->Export = Param("export");
			$custom = Param("custom", "");
		} elseif (IsPost()) {
			if (Post("exporttype") !== NULL)
				$this->Export = Post("exporttype");
			$custom = Post("custom", "");
		} elseif (Get("cmd") == "json") {
			$this->Export = Get("cmd");
		} else {
			$this->setExportReturnUrl(CurrentUrl());
		}
		$ExportFileName = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->isExport() && $custom <> "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$CustomExportType = $this->CustomExport;
		$ExportType = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (defined(PROJECT_NAMESPACE . "USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (defined(PROJECT_NAMESPACE . "USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = Param("action"); // Set up current action

		// Get grid add count
		$gridaddcnt = Get(TABLE_GRID_ADD_ROW_COUNT, "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();

		// Setup export options
		$this->setupExportOptions();
		$this->ID_Route->Visible = FALSE;
		$this->RouteName->setVisibility();
		$this->TruckNo->setVisibility();
		$this->DriverName->setVisibility();
		$this->DriverMobile->setVisibility();
		$this->InvoiceNo->setVisibility();
		$this->InvoiceDate->setVisibility();
		$this->CreateUser->setVisibility();
		$this->CreateDate->setVisibility();
		$this->UpdateUser->Visible = FALSE;
		$this->UpdateDate->Visible = FALSE;
		$this->InOrOut->Visible = FALSE;
		$this->FinishUnload->setVisibility();
		$this->SealNo->setVisibility();
		$this->DepartureTime->Visible = FALSE;
		$this->FinishLoading->Visible = FALSE;
		$this->AttachFile->setVisibility();
		$this->LoadingID->setVisibility();
		$this->Id_Type->setVisibility();
		$this->hideFieldsForAddEdit();

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

		// Setup other options
		$this->setupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}

		// Set up lookup cache
		// Search filters

		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Process list action first
			if ($this->processListAction()) // Ajax request
				$this->terminate();

			// Set up records per page
			$this->setupDisplayRecs();

			// Handle reset command
			$this->resetCmd();

			// Set up Breadcrumb
			if (!$this->isExport())
				$this->setupBreadcrumb();

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->isExport() || $this->CurrentAction) {
				$this->ExportOptions->hideAllOptions();
				$this->FilterOptions->hideAllOptions();
				$this->ImportOptions->hideAllOptions();
			}

			// Hide other options
			if ($this->isExport())
				$this->OtherOptions->hideAllOptions();

			// Get default search criteria
			AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(TRUE));
			AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(TRUE));

			// Get basic search values
			$this->loadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->loadSearchValues(); // Get search values

			// Process filter list
			if ($this->processFilterList())
				$this->terminate();
			if (!$this->validateSearch())
				$this->setFailureMessage($SearchError);

			// Restore search parms from Session if not searching / reset / export
			if (($this->isExport() || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->Command <> "json" && $this->checkSearchParms())
				$this->restoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->setupSortOrder();

			// Get basic search criteria
			if ($SearchError == "")
				$srchBasic = $this->basicSearchWhere();

			// Get search criteria for advanced search
			if ($SearchError == "")
				$srchAdvanced = $this->advancedSearchWhere();
		}

		// Restore display records
		if ($this->Command <> "json" && $this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		if ($this->Command <> "json")
			$this->loadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->checkSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->loadDefault();
			if ($this->BasicSearch->Keyword != "")
				$srchBasic = $this->basicSearchWhere();

			// Load advanced search from default
			if ($this->loadAdvancedSearchDefault()) {
				$srchAdvanced = $this->advancedSearchWhere();
			}
		}

		// Build search criteria
		AddFilter($this->SearchWhere, $srchAdvanced);
		AddFilter($this->SearchWhere, $srchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->Command <> "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}

		// Export selected records
		if ($this->isExport())
			$this->CurrentFilter = $this->buildExportSelectedFilter();

		// Export data only
		if (!$this->CustomExport && in_array($this->Export, array_keys($EXPORT))) {
			$this->exportData();
			$this->terminate();
		}
		if ($this->isGridAdd()) {
			$this->CurrentFilter = "0=1";
			$this->StartRec = 1;
			$this->DisplayRecs = $this->GridAddRowCount;
			$this->TotalRecs = $this->DisplayRecs;
			$this->StopRec = $this->DisplayRecs;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecs = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
			$this->StartRec = 1;
			if ($this->DisplayRecs <= 0 || ($this->isExport() && $this->ExportAll)) // Display all records
				$this->DisplayRecs = $this->TotalRecs;
			if (!($this->isExport() && $this->ExportAll)) // Set up start record position
				$this->setupStartRec();
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRec - 1, $this->DisplayRecs);

			// Set no record found message
			if (!$this->CurrentAction && $this->TotalRecs == 0) {
				if (!$Security->canList())
					$this->setWarningMessage(DeniedMessage());
				if ($this->SearchWhere == "0=101")
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				else
					$this->setWarningMessage($Language->phrase("NoRecord"));
			}

			// Audit trail on search
			if ($this->AuditTrailOnSearch && $this->Command == "search" && !$this->RestoreSearch) {
				$searchParm = ServerVar("QUERY_STRING");
				$searchSql = $this->getSessionWhere();
				$this->writeAuditTrailOnSearch($searchParm, $searchSql);
			}
		}

		// Search options
		$this->setupSearchOptions();

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecs]);
			$this->terminate(TRUE);
		}
	}

	// Set up number of records displayed per page
	protected function setupDisplayRecs()
	{
		$wrk = Get(TABLE_REC_PER_PAGE, "");
		if ($wrk <> "") {
			if (is_numeric($wrk)) {
				$this->DisplayRecs = (int)$wrk;
			} else {
				if (SameText($wrk, "all")) { // Display all records
					$this->DisplayRecs = -1;
				} else {
					$this->DisplayRecs = 20; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey <> "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter <> "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode($GLOBALS["COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arKeyFlds) >= 1) {
			$this->ID_Route->setFormValue($arKeyFlds[0]);
			if (!is_numeric($this->ID_Route->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";
		$filterList = Concat($filterList, $this->RouteName->AdvancedSearch->toJson(), ","); // Field RouteName
		$filterList = Concat($filterList, $this->TruckNo->AdvancedSearch->toJson(), ","); // Field TruckNo
		$filterList = Concat($filterList, $this->DriverName->AdvancedSearch->toJson(), ","); // Field DriverName
		$filterList = Concat($filterList, $this->DriverMobile->AdvancedSearch->toJson(), ","); // Field DriverMobile
		$filterList = Concat($filterList, $this->InvoiceNo->AdvancedSearch->toJson(), ","); // Field InvoiceNo
		$filterList = Concat($filterList, $this->InvoiceDate->AdvancedSearch->toJson(), ","); // Field InvoiceDate
		$filterList = Concat($filterList, $this->CreateUser->AdvancedSearch->toJson(), ","); // Field CreateUser
		$filterList = Concat($filterList, $this->CreateDate->AdvancedSearch->toJson(), ","); // Field CreateDate
		$filterList = Concat($filterList, $this->UpdateUser->AdvancedSearch->toJson(), ","); // Field UpdateUser
		$filterList = Concat($filterList, $this->UpdateDate->AdvancedSearch->toJson(), ","); // Field UpdateDate
		$filterList = Concat($filterList, $this->InOrOut->AdvancedSearch->toJson(), ","); // Field InOrOut
		$filterList = Concat($filterList, $this->FinishUnload->AdvancedSearch->toJson(), ","); // Field FinishUnload
		$filterList = Concat($filterList, $this->SealNo->AdvancedSearch->toJson(), ","); // Field SealNo
		$filterList = Concat($filterList, $this->AttachFile->AdvancedSearch->toJson(), ","); // Field AttachFile
		$filterList = Concat($filterList, $this->LoadingID->AdvancedSearch->toJson(), ","); // Field LoadingID
		$filterList = Concat($filterList, $this->Id_Type->AdvancedSearch->toJson(), ","); // Field Id_Type
		if ($this->BasicSearch->Keyword <> "") {
			$wrk = "\"" . TABLE_BASIC_SEARCH . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . TABLE_BASIC_SEARCH_TYPE . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
			$filterList = Concat($filterList, $wrk, ",");
		}

		// Return filter list in JSON
		if ($filterList <> "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList <> "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList <> "") ? "{" . $filterList . "}" : "null";
	}

	// Process filter list
	protected function processFilterList()
	{
		global $UserProfile;
		if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
			$filters = Post("filters");
			$UserProfile->setSearchFilters(CurrentUserName(), "ftbl_routelistsrch", $filters);
			WriteJson([["success" => TRUE]]); // Success
			return TRUE;
		} elseif (Post("cmd") == "resetfilter") {
			$this->restoreFilterList();
		}
		return FALSE;
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd") !== "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter"), TRUE);
		$this->Command = "search";

		// Field RouteName
		$this->RouteName->AdvancedSearch->SearchValue = @$filter["x_RouteName"];
		$this->RouteName->AdvancedSearch->SearchOperator = @$filter["z_RouteName"];
		$this->RouteName->AdvancedSearch->SearchCondition = @$filter["v_RouteName"];
		$this->RouteName->AdvancedSearch->SearchValue2 = @$filter["y_RouteName"];
		$this->RouteName->AdvancedSearch->SearchOperator2 = @$filter["w_RouteName"];
		$this->RouteName->AdvancedSearch->save();

		// Field TruckNo
		$this->TruckNo->AdvancedSearch->SearchValue = @$filter["x_TruckNo"];
		$this->TruckNo->AdvancedSearch->SearchOperator = @$filter["z_TruckNo"];
		$this->TruckNo->AdvancedSearch->SearchCondition = @$filter["v_TruckNo"];
		$this->TruckNo->AdvancedSearch->SearchValue2 = @$filter["y_TruckNo"];
		$this->TruckNo->AdvancedSearch->SearchOperator2 = @$filter["w_TruckNo"];
		$this->TruckNo->AdvancedSearch->save();

		// Field DriverName
		$this->DriverName->AdvancedSearch->SearchValue = @$filter["x_DriverName"];
		$this->DriverName->AdvancedSearch->SearchOperator = @$filter["z_DriverName"];
		$this->DriverName->AdvancedSearch->SearchCondition = @$filter["v_DriverName"];
		$this->DriverName->AdvancedSearch->SearchValue2 = @$filter["y_DriverName"];
		$this->DriverName->AdvancedSearch->SearchOperator2 = @$filter["w_DriverName"];
		$this->DriverName->AdvancedSearch->save();

		// Field DriverMobile
		$this->DriverMobile->AdvancedSearch->SearchValue = @$filter["x_DriverMobile"];
		$this->DriverMobile->AdvancedSearch->SearchOperator = @$filter["z_DriverMobile"];
		$this->DriverMobile->AdvancedSearch->SearchCondition = @$filter["v_DriverMobile"];
		$this->DriverMobile->AdvancedSearch->SearchValue2 = @$filter["y_DriverMobile"];
		$this->DriverMobile->AdvancedSearch->SearchOperator2 = @$filter["w_DriverMobile"];
		$this->DriverMobile->AdvancedSearch->save();

		// Field InvoiceNo
		$this->InvoiceNo->AdvancedSearch->SearchValue = @$filter["x_InvoiceNo"];
		$this->InvoiceNo->AdvancedSearch->SearchOperator = @$filter["z_InvoiceNo"];
		$this->InvoiceNo->AdvancedSearch->SearchCondition = @$filter["v_InvoiceNo"];
		$this->InvoiceNo->AdvancedSearch->SearchValue2 = @$filter["y_InvoiceNo"];
		$this->InvoiceNo->AdvancedSearch->SearchOperator2 = @$filter["w_InvoiceNo"];
		$this->InvoiceNo->AdvancedSearch->save();

		// Field InvoiceDate
		$this->InvoiceDate->AdvancedSearch->SearchValue = @$filter["x_InvoiceDate"];
		$this->InvoiceDate->AdvancedSearch->SearchOperator = @$filter["z_InvoiceDate"];
		$this->InvoiceDate->AdvancedSearch->SearchCondition = @$filter["v_InvoiceDate"];
		$this->InvoiceDate->AdvancedSearch->SearchValue2 = @$filter["y_InvoiceDate"];
		$this->InvoiceDate->AdvancedSearch->SearchOperator2 = @$filter["w_InvoiceDate"];
		$this->InvoiceDate->AdvancedSearch->save();

		// Field CreateUser
		$this->CreateUser->AdvancedSearch->SearchValue = @$filter["x_CreateUser"];
		$this->CreateUser->AdvancedSearch->SearchOperator = @$filter["z_CreateUser"];
		$this->CreateUser->AdvancedSearch->SearchCondition = @$filter["v_CreateUser"];
		$this->CreateUser->AdvancedSearch->SearchValue2 = @$filter["y_CreateUser"];
		$this->CreateUser->AdvancedSearch->SearchOperator2 = @$filter["w_CreateUser"];
		$this->CreateUser->AdvancedSearch->save();

		// Field CreateDate
		$this->CreateDate->AdvancedSearch->SearchValue = @$filter["x_CreateDate"];
		$this->CreateDate->AdvancedSearch->SearchOperator = @$filter["z_CreateDate"];
		$this->CreateDate->AdvancedSearch->SearchCondition = @$filter["v_CreateDate"];
		$this->CreateDate->AdvancedSearch->SearchValue2 = @$filter["y_CreateDate"];
		$this->CreateDate->AdvancedSearch->SearchOperator2 = @$filter["w_CreateDate"];
		$this->CreateDate->AdvancedSearch->save();

		// Field UpdateUser
		$this->UpdateUser->AdvancedSearch->SearchValue = @$filter["x_UpdateUser"];
		$this->UpdateUser->AdvancedSearch->SearchOperator = @$filter["z_UpdateUser"];
		$this->UpdateUser->AdvancedSearch->SearchCondition = @$filter["v_UpdateUser"];
		$this->UpdateUser->AdvancedSearch->SearchValue2 = @$filter["y_UpdateUser"];
		$this->UpdateUser->AdvancedSearch->SearchOperator2 = @$filter["w_UpdateUser"];
		$this->UpdateUser->AdvancedSearch->save();

		// Field UpdateDate
		$this->UpdateDate->AdvancedSearch->SearchValue = @$filter["x_UpdateDate"];
		$this->UpdateDate->AdvancedSearch->SearchOperator = @$filter["z_UpdateDate"];
		$this->UpdateDate->AdvancedSearch->SearchCondition = @$filter["v_UpdateDate"];
		$this->UpdateDate->AdvancedSearch->SearchValue2 = @$filter["y_UpdateDate"];
		$this->UpdateDate->AdvancedSearch->SearchOperator2 = @$filter["w_UpdateDate"];
		$this->UpdateDate->AdvancedSearch->save();

		// Field InOrOut
		$this->InOrOut->AdvancedSearch->SearchValue = @$filter["x_InOrOut"];
		$this->InOrOut->AdvancedSearch->SearchOperator = @$filter["z_InOrOut"];
		$this->InOrOut->AdvancedSearch->SearchCondition = @$filter["v_InOrOut"];
		$this->InOrOut->AdvancedSearch->SearchValue2 = @$filter["y_InOrOut"];
		$this->InOrOut->AdvancedSearch->SearchOperator2 = @$filter["w_InOrOut"];
		$this->InOrOut->AdvancedSearch->save();

		// Field FinishUnload
		$this->FinishUnload->AdvancedSearch->SearchValue = @$filter["x_FinishUnload"];
		$this->FinishUnload->AdvancedSearch->SearchOperator = @$filter["z_FinishUnload"];
		$this->FinishUnload->AdvancedSearch->SearchCondition = @$filter["v_FinishUnload"];
		$this->FinishUnload->AdvancedSearch->SearchValue2 = @$filter["y_FinishUnload"];
		$this->FinishUnload->AdvancedSearch->SearchOperator2 = @$filter["w_FinishUnload"];
		$this->FinishUnload->AdvancedSearch->save();

		// Field SealNo
		$this->SealNo->AdvancedSearch->SearchValue = @$filter["x_SealNo"];
		$this->SealNo->AdvancedSearch->SearchOperator = @$filter["z_SealNo"];
		$this->SealNo->AdvancedSearch->SearchCondition = @$filter["v_SealNo"];
		$this->SealNo->AdvancedSearch->SearchValue2 = @$filter["y_SealNo"];
		$this->SealNo->AdvancedSearch->SearchOperator2 = @$filter["w_SealNo"];
		$this->SealNo->AdvancedSearch->save();

		// Field AttachFile
		$this->AttachFile->AdvancedSearch->SearchValue = @$filter["x_AttachFile"];
		$this->AttachFile->AdvancedSearch->SearchOperator = @$filter["z_AttachFile"];
		$this->AttachFile->AdvancedSearch->SearchCondition = @$filter["v_AttachFile"];
		$this->AttachFile->AdvancedSearch->SearchValue2 = @$filter["y_AttachFile"];
		$this->AttachFile->AdvancedSearch->SearchOperator2 = @$filter["w_AttachFile"];
		$this->AttachFile->AdvancedSearch->save();

		// Field LoadingID
		$this->LoadingID->AdvancedSearch->SearchValue = @$filter["x_LoadingID"];
		$this->LoadingID->AdvancedSearch->SearchOperator = @$filter["z_LoadingID"];
		$this->LoadingID->AdvancedSearch->SearchCondition = @$filter["v_LoadingID"];
		$this->LoadingID->AdvancedSearch->SearchValue2 = @$filter["y_LoadingID"];
		$this->LoadingID->AdvancedSearch->SearchOperator2 = @$filter["w_LoadingID"];
		$this->LoadingID->AdvancedSearch->save();

		// Field Id_Type
		$this->Id_Type->AdvancedSearch->SearchValue = @$filter["x_Id_Type"];
		$this->Id_Type->AdvancedSearch->SearchOperator = @$filter["z_Id_Type"];
		$this->Id_Type->AdvancedSearch->SearchCondition = @$filter["v_Id_Type"];
		$this->Id_Type->AdvancedSearch->SearchValue2 = @$filter["y_Id_Type"];
		$this->Id_Type->AdvancedSearch->SearchOperator2 = @$filter["w_Id_Type"];
		$this->Id_Type->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[TABLE_BASIC_SEARCH_TYPE]);
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		if (!$Security->canSearch())
			return "";
		$this->buildSearchSql($where, $this->RouteName, $default, FALSE); // RouteName
		$this->buildSearchSql($where, $this->TruckNo, $default, FALSE); // TruckNo
		$this->buildSearchSql($where, $this->DriverName, $default, FALSE); // DriverName
		$this->buildSearchSql($where, $this->DriverMobile, $default, FALSE); // DriverMobile
		$this->buildSearchSql($where, $this->InvoiceNo, $default, FALSE); // InvoiceNo
		$this->buildSearchSql($where, $this->InvoiceDate, $default, FALSE); // InvoiceDate
		$this->buildSearchSql($where, $this->CreateUser, $default, FALSE); // CreateUser
		$this->buildSearchSql($where, $this->CreateDate, $default, FALSE); // CreateDate
		$this->buildSearchSql($where, $this->UpdateUser, $default, FALSE); // UpdateUser
		$this->buildSearchSql($where, $this->UpdateDate, $default, FALSE); // UpdateDate
		$this->buildSearchSql($where, $this->InOrOut, $default, FALSE); // InOrOut
		$this->buildSearchSql($where, $this->FinishUnload, $default, FALSE); // FinishUnload
		$this->buildSearchSql($where, $this->SealNo, $default, FALSE); // SealNo
		$this->buildSearchSql($where, $this->AttachFile, $default, FALSE); // AttachFile
		$this->buildSearchSql($where, $this->LoadingID, $default, FALSE); // LoadingID
		$this->buildSearchSql($where, $this->Id_Type, $default, FALSE); // Id_Type

		// Set up search parm
		if (!$default && $where <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->RouteName->AdvancedSearch->save(); // RouteName
			$this->TruckNo->AdvancedSearch->save(); // TruckNo
			$this->DriverName->AdvancedSearch->save(); // DriverName
			$this->DriverMobile->AdvancedSearch->save(); // DriverMobile
			$this->InvoiceNo->AdvancedSearch->save(); // InvoiceNo
			$this->InvoiceDate->AdvancedSearch->save(); // InvoiceDate
			$this->CreateUser->AdvancedSearch->save(); // CreateUser
			$this->CreateDate->AdvancedSearch->save(); // CreateDate
			$this->UpdateUser->AdvancedSearch->save(); // UpdateUser
			$this->UpdateDate->AdvancedSearch->save(); // UpdateDate
			$this->InOrOut->AdvancedSearch->save(); // InOrOut
			$this->FinishUnload->AdvancedSearch->save(); // FinishUnload
			$this->SealNo->AdvancedSearch->save(); // SealNo
			$this->AttachFile->AdvancedSearch->save(); // AttachFile
			$this->LoadingID->AdvancedSearch->save(); // LoadingID
			$this->Id_Type->AdvancedSearch->save(); // Id_Type
		}
		return $where;
	}

	// Build search SQL
	protected function buildSearchSql(&$where, &$fld, $default, $multiValue)
	{
		$fldParm = $fld->Param;
		$fldVal = ($default) ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
		$fldOpr = ($default) ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
		$fldCond = ($default) ? $fld->AdvancedSearch->SearchConditionDefault : $fld->AdvancedSearch->SearchCondition;
		$fldVal2 = ($default) ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
		$fldOpr2 = ($default) ? $fld->AdvancedSearch->SearchOperator2Default : $fld->AdvancedSearch->SearchOperator2;
		$wrk = "";
		if (is_array($fldVal))
			$fldVal = implode(",", $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(",", $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		if ($fldOpr == "")
			$fldOpr = "=";
		$fldOpr2 = strtoupper(trim($fldOpr2));
		if ($fldOpr2 == "")
			$fldOpr2 = "=";
		if (SEARCH_MULTI_VALUE_OPTION == 1)
			$multiValue = FALSE;
		if ($multiValue) {
			$wrk1 = ($fldVal <> "") ? GetMultiSearchSql($fld, $fldOpr, $fldVal, $this->Dbid) : ""; // Field value 1
			$wrk2 = ($fldVal2 <> "") ? GetMultiSearchSql($fld, $fldOpr2, $fldVal2, $this->Dbid) : ""; // Field value 2
			$wrk = $wrk1; // Build final SQL
			if ($wrk2 <> "")
				$wrk = ($wrk <> "") ? "($wrk) $fldCond ($wrk2)" : $wrk2;
		} else {
			$fldVal = $this->convertSearchValue($fld, $fldVal);
			$fldVal2 = $this->convertSearchValue($fld, $fldVal2);
			$wrk = GetSearchSql($fld, $fldVal, $fldOpr, $fldCond, $fldVal2, $fldOpr2, $this->Dbid);
		}
		AddFilter($where, $wrk);
	}

	// Convert search value
	protected function convertSearchValue(&$fld, $fldVal)
	{
		if ($fldVal == NULL_VALUE || $fldVal == NOT_NULL_VALUE)
			return $fldVal;
		$value = $fldVal;
		if ($fld->DataType == DATATYPE_BOOLEAN) {
			if ($fldVal <> "")
				$value = (SameText($fldVal, "1") || SameText($fldVal, "y") || SameText($fldVal, "t")) ? $fld->TrueValue : $fld->FalseValue;
		} elseif ($fld->DataType == DATATYPE_DATE || $fld->DataType == DATATYPE_TIME) {
			if ($fldVal <> "")
				$value = UnFormatDateTime($fldVal, $fld->DateTimeFormat);
		}
		return $value;
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->RouteName, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->TruckNo, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->DriverName, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->DriverMobile, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->InvoiceNo, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->CreateUser, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->FinishUnload, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->SealNo, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->AttachFile, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->LoadingID, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Id_Type, $arKeywords, $type);
		return $where;
	}

	// Build basic search SQL
	protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
	{
		global $BASIC_SEARCH_IGNORE_PATTERN;
		$defCond = ($type == "OR") ? "OR" : "AND";
		$arSql = array(); // Array for SQL parts
		$arCond = array(); // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$keyword = $arKeywords[$i];
			$keyword = trim($keyword);
			if ($BASIC_SEARCH_IGNORE_PATTERN <> "") {
				$keyword = preg_replace($BASIC_SEARCH_IGNORE_PATTERN, "\\", $keyword);
				$ar = explode("\\", $keyword);
			} else {
				$ar = array($keyword);
			}
			foreach ($ar as $keyword) {
				if ($keyword <> "") {
					$wrk = "";
					if ($keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j - 1] = "OR";
					} elseif ($keyword == NULL_VALUE) {
						$wrk = $fld->Expression . " IS NULL";
					} elseif ($keyword == NOT_NULL_VALUE) {
						$wrk = $fld->Expression . " IS NOT NULL";
					} elseif ($fld->IsVirtual) {
						$wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					} elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
						$wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					}
					if ($wrk <> "") {
						$arSql[$j] = $wrk;
						$arCond[$j] = $defCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSql);
		$quoted = FALSE;
		$sql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt - 1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$quoted)
						$sql .= "(";
					$quoted = TRUE;
				}
				$sql .= $arSql[$i];
				if ($quoted && $arCond[$i] <> "OR") {
					$sql .= ")";
					$quoted = FALSE;
				}
				$sql .= " " . $arCond[$i] . " ";
			}
			$sql .= $arSql[$cnt - 1];
			if ($quoted)
				$sql .= ")";
		}
		if ($sql <> "") {
			if ($where <> "")
				$where .= " OR ";
			$where .= "(" . $sql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	protected function basicSearchWhere($default = FALSE)
	{
		global $Security;
		$searchStr = "";
		if (!$Security->canSearch())
			return "";
		$searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($searchKeyword <> "") {
			$ar = $this->BasicSearch->keywordList($default);

			// Search keyword in any fields
			if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $keyword) {
					if ($keyword <> "") {
						if ($searchStr <> "")
							$searchStr .= " " . $searchType . " ";
						$searchStr .= "(" . $this->basicSearchSql(array($keyword), $searchType) . ")";
					}
				}
			} else {
				$searchStr = $this->basicSearchSql($ar, $searchType);
			}
			if (!$default && in_array($this->Command, array("", "reset", "resetall")))
				$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($searchKeyword);
			$this->BasicSearch->setType($searchType);
		}
		return $searchStr;
	}

	// Check if search parm exists
	protected function checkSearchParms()
	{

		// Check basic search
		if ($this->BasicSearch->issetSession())
			return TRUE;
		if ($this->RouteName->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->TruckNo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DriverName->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DriverMobile->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->InvoiceNo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->InvoiceDate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->CreateUser->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->CreateDate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->UpdateUser->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->UpdateDate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->InOrOut->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->FinishUnload->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->SealNo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AttachFile->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LoadingID->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Id_Type->AdvancedSearch->issetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	protected function resetSearchParms()
	{

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->resetBasicSearchParms();

		// Clear advanced search parameters
		$this->resetAdvancedSearchParms();
	}

	// Load advanced search default values
	protected function loadAdvancedSearchDefault()
	{
		return FALSE;
	}

	// Clear all basic search parameters
	protected function resetBasicSearchParms()
	{
		$this->BasicSearch->unsetSession();
	}

	// Clear all advanced search parameters
	protected function resetAdvancedSearchParms()
	{
		$this->RouteName->AdvancedSearch->unsetSession();
		$this->TruckNo->AdvancedSearch->unsetSession();
		$this->DriverName->AdvancedSearch->unsetSession();
		$this->DriverMobile->AdvancedSearch->unsetSession();
		$this->InvoiceNo->AdvancedSearch->unsetSession();
		$this->InvoiceDate->AdvancedSearch->unsetSession();
		$this->CreateUser->AdvancedSearch->unsetSession();
		$this->CreateDate->AdvancedSearch->unsetSession();
		$this->UpdateUser->AdvancedSearch->unsetSession();
		$this->UpdateDate->AdvancedSearch->unsetSession();
		$this->InOrOut->AdvancedSearch->unsetSession();
		$this->FinishUnload->AdvancedSearch->unsetSession();
		$this->SealNo->AdvancedSearch->unsetSession();
		$this->AttachFile->AdvancedSearch->unsetSession();
		$this->LoadingID->AdvancedSearch->unsetSession();
		$this->Id_Type->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->RouteName->AdvancedSearch->load();
		$this->TruckNo->AdvancedSearch->load();
		$this->DriverName->AdvancedSearch->load();
		$this->DriverMobile->AdvancedSearch->load();
		$this->InvoiceNo->AdvancedSearch->load();
		$this->InvoiceDate->AdvancedSearch->load();
		$this->CreateUser->AdvancedSearch->load();
		$this->CreateDate->AdvancedSearch->load();
		$this->UpdateUser->AdvancedSearch->load();
		$this->UpdateDate->AdvancedSearch->load();
		$this->InOrOut->AdvancedSearch->load();
		$this->FinishUnload->AdvancedSearch->load();
		$this->SealNo->AdvancedSearch->load();
		$this->AttachFile->AdvancedSearch->load();
		$this->LoadingID->AdvancedSearch->load();
		$this->Id_Type->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for Ctrl pressed
		$ctrl = Get("ctrl") !== NULL;

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->RouteName, $ctrl); // RouteName
			$this->updateSort($this->TruckNo, $ctrl); // TruckNo
			$this->updateSort($this->DriverName, $ctrl); // DriverName
			$this->updateSort($this->DriverMobile, $ctrl); // DriverMobile
			$this->updateSort($this->InvoiceNo, $ctrl); // InvoiceNo
			$this->updateSort($this->InvoiceDate, $ctrl); // InvoiceDate
			$this->updateSort($this->CreateUser, $ctrl); // CreateUser
			$this->updateSort($this->CreateDate, $ctrl); // CreateDate
			$this->updateSort($this->FinishUnload, $ctrl); // FinishUnload
			$this->updateSort($this->SealNo, $ctrl); // SealNo
			$this->updateSort($this->AttachFile, $ctrl); // AttachFile
			$this->updateSort($this->LoadingID, $ctrl); // LoadingID
			$this->updateSort($this->Id_Type, $ctrl); // Id_Type
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
				$this->CreateDate->setSort("DESC");
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->resetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->RouteName->setSort("");
				$this->TruckNo->setSort("");
				$this->DriverName->setSort("");
				$this->DriverMobile->setSort("");
				$this->InvoiceNo->setSort("");
				$this->InvoiceDate->setSort("");
				$this->CreateUser->setSort("");
				$this->CreateDate->setSort("");
				$this->FinishUnload->setSort("");
				$this->SealNo->setSort("");
				$this->AttachFile->setSort("");
				$this->LoadingID->setSort("");
				$this->Id_Type->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = TRUE;

		// "detail_vwRouteUnload"
		$item = &$this->ListOptions->add("detail_vwRouteUnload");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'vwRouteUnload') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["vwRouteUnload_grid"]))
			$GLOBALS["vwRouteUnload_grid"] = new vwRouteUnload_grid();

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$this->ListOptions->add("details");
			$item->CssClass = "text-nowrap";
			$item->Visible = $this->ShowMultipleDetails;
			$item->OnLeft = TRUE;
			$item->ShowInButtonGroup = FALSE;
		}

		// Set up detail pages
		$pages = new SubPages();
		$pages->add("vwRouteUnload");
		$this->DetailPages = $pages;

		// List actions
		$item = &$this->ListOptions->add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->add("checkbox");
		$item->Visible = TRUE;
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew.selectAllKey(this);\">";
		$item->moveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// "sequence"
		$item = &$this->ListOptions->add("sequence");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE; // Always on left
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$this->setupListOptionsExt();
		$item = &$this->ListOptions->getItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// "sequence"
		$opt = &$this->ListOptions->Items["sequence"];
		$opt->Body = FormatSequenceNumber($this->RecCnt);

		// "edit"
		$opt = &$this->ListOptions->Items["edit"];
		$editcaption = HtmlTitle($Language->phrase("EditLink"));
		if ($Security->canEdit()) {
			$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("EditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// Set up list action buttons
		$opt = &$this->ListOptions->getItem("listactions");
		if ($opt && !$this->isExport() && !$this->CurrentAction) {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
					$links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));return false;\">" . $Language->phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$opt->Body = $body;
				$opt->Visible = TRUE;
			}
		}
		$detailViewTblVar = "";
		$detailCopyTblVar = "";
		$detailEditTblVar = "";

		// "detail_vwRouteUnload"
		$opt = &$this->ListOptions->Items["detail_vwRouteUnload"];
		if ($Security->allowList(CurrentProjectID() . 'vwRouteUnload')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("vwRouteUnload", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->vwRouteUnload_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("vwRouteUnloadlist.php?" . TABLE_SHOW_MASTER . "=tbl_route&fk_ID_Route=" . urlencode(strval($this->ID_Route->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["vwRouteUnload_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vwRouteUnload')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(TABLE_SHOW_DETAIL . "=vwRouteUnload");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar <> "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "vwRouteUnload";
			}
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
			$opt->Body = $body;
			if ($this->ShowMultipleDetails)
				$opt->Visible = FALSE;
		}
		if ($this->ShowMultipleDetails) {
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">";
			$links = "";
			if ($detailViewTblVar <> "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(TABLE_SHOW_DETAIL . "=" . $detailViewTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			}
			if ($detailEditTblVar <> "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(TABLE_SHOW_DETAIL . "=" . $detailEditTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			}
			if ($detailCopyTblVar <> "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->GetCopyUrl(TABLE_SHOW_DETAIL . "=" . $detailCopyTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			}
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-master-detail\" title=\"" . HtmlTitle($Language->phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("MultipleMasterDetails") . "</button>";
				$body .= "<ul class=\"dropdown-menu ew-menu\">". $links . "</ul>";
			}
			$body .= "</div>";

			// Multiple details
			$opt = &$this->ListOptions->Items["details"];
			$opt->Body = $body;
		}

		// "checkbox"
		$opt = &$this->ListOptions->Items["checkbox"];
		$opt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ew-multi-select\" value=\"" . HtmlEncode($this->ID_Route->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\">";
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("AddLink"));
		if (IsMobile())
			$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-table=\"tbl_route\" data-caption=\"" . $addcaption . "\" href=\"javascript:void(0);\" onclick=\"ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode($this->AddUrl) . "'});\">" . $Language->phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->canAdd());
		$option = $options["detail"];
		$detailTableLink = "";
		$item = &$option->add("detailadd_vwRouteUnload");
		$url = $this->getAddUrl(TABLE_SHOW_DETAIL . "=vwRouteUnload");
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["vwRouteUnload"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["vwRouteUnload"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'vwRouteUnload') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink <> "")
				$detailTableLink .= ",";
			$detailTableLink .= "vwRouteUnload";
		}

		// Add multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$option->add("detailsadd");
			$url = $this->getAddUrl(TABLE_SHOW_DETAIL . "=" . $detailTableLink);
			$caption = $Language->phrase("AddMasterDetailLink");
			$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
			$item->Visible = ($detailTableLink <> "" && $Security->canAdd());

			// Hide single master/detail items
			$ar = explode(",", $detailTableLink);
			$cnt = count($ar);
			for ($i = 0; $i < $cnt; $i++) {
				if ($item = &$option->getItem("detailadd_" . $ar[$i]))
					$item->Visible = FALSE;
			}
		}
		$option = $options["action"];

		// Add multi delete
		$item = &$option->add("multidelete");
		$item->Body = "<a class=\"ew-action ew-multi-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" href=\"\" onclick=\"ew.submitAction(event,{f:document.ftbl_routelist,url:'" . $this->MultiDeleteUrl . "',data:{action:'show'}});return false;\">" . $Language->phrase("DeleteSelectedLink") . "</a>";
		$item->Visible = ($Security->canDelete());

		// Set up options default
		foreach ($options as &$option) {
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;

			//$option->ButtonClass = ""; // Class for button group
			$item = &$option->add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"ftbl_routelistsrch\" href=\"#\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"ftbl_routelistsrch\" href=\"#\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({f:document.ftbl_routelist}," . $listaction->toJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->getItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->hideAllOptions();
			}
	}

	// Process list action
	protected function processListAction()
	{
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$filter = $this->getFilterFromRecordKeys();
		$userAction = Post("useraction", "");
		if ($filter <> "" && $userAction <> "") {

			// Check permission first
			$actionCaption = $userAction;
			if (array_key_exists($userAction, $this->ListActions->Items)) {
				$actionCaption = $this->ListActions->Items[$userAction]->Caption;
				if (!$this->ListActions->Items[$userAction]->Allow) {
					$errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
					if (Post("ajax") == $userAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $filter;
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$rs = $conn->execute($sql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $userAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->beginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$processed = $this->Row_CustomAction($userAction, $row);
					if (!$processed)
						break;
					$rs->moveNext();
				}
				if ($processed) {
					$conn->commitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "" && !ob_get_length()) // No output
						$this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->rollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->close();
			$this->CurrentAction = ""; // Clear action
			if (Post("ajax") == $userAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->clearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->clearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Search button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = ($this->SearchWhere <> "") ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"ftbl_routelistsrch\">" . $Language->phrase("SearchLink") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<button type=\"button\" class=\"btn btn-default ew-highlight active\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"ftbl_routelistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</button>";
		$item->Visible = ($this->SearchWhere <> "" && $this->TotalRecs > 0);

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->isExport() || $this->CurrentAction)
			$this->SearchOptions->hideAllOptions();
		global $Security;
		if (!$Security->canSearch()) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}
	}
	protected function setupListOptionsExt()
	{
		global $Security, $Language;

		// Hide detail items for dropdown if necessary
		$this->ListOptions->hideDetailItemsForDropDown();
	}
	protected function renderListOptionsExt()
	{
		global $Security, $Language;
		$links = "";
		$btngrps = "";
		$sqlwrk = "`ID_Route`=" . AdjustSql($this->ID_Route->CurrentValue, $this->Dbid) . "";

		// Column "detail_vwRouteUnload"
		if ($this->DetailPages->Items["vwRouteUnload"]->Visible) {
			$link = "";
			$option = &$this->ListOptions->Items["detail_vwRouteUnload"];
			$url = "vwRouteUnloadpreview.php?t=tbl_route&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"vwRouteUnload\" data-url=\"" . $url . "\" class=\"btn-group btn-group-sm\">";
			if ($Security->allowList(CurrentProjectID() . 'vwRouteUnload')) {
				$label = $Language->TablePhrase("vwRouteUnload", "TblCaption");
				$label .= "&nbsp;" . JsEncode(str_replace("%c", $this->vwRouteUnload_Count, $Language->Phrase("DetailCount")));
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"vwRouteUnload\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("vwRouteUnloadlist.php?" . TABLE_SHOW_MASTER . "=tbl_route&fk_ID_Route=" . urlencode(strval($this->ID_Route->CurrentValue)) . "");
				$btngrp .= "<button type=\"button\" class=\"btn btn-default\" title=\"" . $Language->TablePhrase("vwRouteUnload", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "'\">" . $Language->Phrase("MasterDetailListLink") . "</button>";
			}
			if (!isset($GLOBALS["vwRouteUnload_grid"]))
				$GLOBALS["vwRouteUnload_grid"] = new vwRouteUnload_grid();
			if ($GLOBALS["vwRouteUnload_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'vwRouteUnload')) {
				$caption = $Language->Phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(TABLE_SHOW_DETAIL . "=vwRouteUnload");
				$btngrp .= "<button type=\"button\" class=\"btn btn-default\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "'\">" . $caption . "</button>";
			}
			if ($GLOBALS["vwRouteUnload_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'vwRouteUnload')) {
				$caption = $Language->Phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(TABLE_SHOW_DETAIL . "=vwRouteUnload");
				$btngrp .= "<button type=\"button\" class=\"btn btn-default\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "'\">" . $caption . "</button>";
			}
			$btngrp .= "</div>";
			if ($link <> "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}

		// Hide detail items if necessary
		$this->ListOptions->hideDetailItemsForDropDown();

		// Column "preview"
		$option = &$this->ListOptions->getItem("preview");
		if (!$option) { // Add preview column
			$option = &$this->ListOptions->add("preview");
			$option->OnLeft = TRUE;
			if ($option->OnLeft) {
				$option->moveTo($this->ListOptions->itemPos("checkbox") + 1);
			} else {
				$option->moveTo($this->ListOptions->itemPos("checkbox"));
			}
			$option->Visible = !($this->isExport() || $this->isGridAdd() || $this->isGridEdit());
			$option->ShowInDropDown = FALSE;
			$option->ShowInButtonGroup = FALSE;
		}
		if ($option) {
			$option->Body = "<i class=\"ew-preview-row-btn ew-icon icon-expand\"></i>";
			$option->Body .= "<div class=\"d-none ew-preview\">" . $links . $btngrps . "</div>";
			if ($option->Visible)
				$option->Visible = $links <> "";
		}

		// Column "details" (Multiple details)
		$option = &$this->ListOptions->getItem("details");
		if ($option) {
			$option->Body .= "<div class=\"d-none ew-preview\">" . $links . $btngrps . "</div>";
			if ($option->Visible)
				$option->Visible = $links <> "";
		}
	}

	// Set up starting record parameters
	public function setupStartRec()
	{
		if ($this->DisplayRecs == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			if (Get(TABLE_START_REC) !== NULL) { // Check for "start" parameter
				$this->StartRec = Get(TABLE_START_REC);
				$this->setStartRecordNumber($this->StartRec);
			} elseif (Get(TABLE_PAGE_NO) !== NULL) {
				$pageNo = Get(TABLE_PAGE_NO);
				if (is_numeric($pageNo)) {
					$this->StartRec = ($pageNo - 1) * $this->DisplayRecs + 1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1) {
						$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->StartRec > $this->TotalRecs) { // Avoid starting record > total records
			$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec - 1) % $this->DisplayRecs <> 0) {
			$this->StartRec = (int)(($this->StartRec - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(TABLE_BASIC_SEARCH, ""), FALSE);
		if ($this->BasicSearch->Keyword <> "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(TABLE_BASIC_SEARCH_TYPE, ""), FALSE);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{
		global $CurrentForm;

		// Load search values
		// RouteName

		if (!$this->isAddOrEdit())
			$this->RouteName->AdvancedSearch->setSearchValue(Get("x_RouteName", Get("RouteName", "")));
		if ($this->RouteName->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->RouteName->AdvancedSearch->setSearchOperator(Get("z_RouteName", ""));

		// TruckNo
		if (!$this->isAddOrEdit())
			$this->TruckNo->AdvancedSearch->setSearchValue(Get("x_TruckNo", Get("TruckNo", "")));
		if ($this->TruckNo->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->TruckNo->AdvancedSearch->setSearchOperator(Get("z_TruckNo", ""));

		// DriverName
		if (!$this->isAddOrEdit())
			$this->DriverName->AdvancedSearch->setSearchValue(Get("x_DriverName", Get("DriverName", "")));
		if ($this->DriverName->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->DriverName->AdvancedSearch->setSearchOperator(Get("z_DriverName", ""));

		// DriverMobile
		if (!$this->isAddOrEdit())
			$this->DriverMobile->AdvancedSearch->setSearchValue(Get("x_DriverMobile", Get("DriverMobile", "")));
		if ($this->DriverMobile->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->DriverMobile->AdvancedSearch->setSearchOperator(Get("z_DriverMobile", ""));

		// InvoiceNo
		if (!$this->isAddOrEdit())
			$this->InvoiceNo->AdvancedSearch->setSearchValue(Get("x_InvoiceNo", Get("InvoiceNo", "")));
		if ($this->InvoiceNo->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->InvoiceNo->AdvancedSearch->setSearchOperator(Get("z_InvoiceNo", ""));

		// InvoiceDate
		if (!$this->isAddOrEdit())
			$this->InvoiceDate->AdvancedSearch->setSearchValue(Get("x_InvoiceDate", Get("InvoiceDate", "")));
		if ($this->InvoiceDate->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->InvoiceDate->AdvancedSearch->setSearchOperator(Get("z_InvoiceDate", ""));

		// CreateUser
		if (!$this->isAddOrEdit())
			$this->CreateUser->AdvancedSearch->setSearchValue(Get("x_CreateUser", Get("CreateUser", "")));
		if ($this->CreateUser->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->CreateUser->AdvancedSearch->setSearchOperator(Get("z_CreateUser", ""));

		// CreateDate
		if (!$this->isAddOrEdit())
			$this->CreateDate->AdvancedSearch->setSearchValue(Get("x_CreateDate", Get("CreateDate", "")));
		if ($this->CreateDate->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->CreateDate->AdvancedSearch->setSearchOperator(Get("z_CreateDate", ""));
		$this->CreateDate->AdvancedSearch->setSearchCondition(Get("v_CreateDate", ""));
		$this->CreateDate->AdvancedSearch->setSearchValue2(Get("y_CreateDate", ""));
		if ($this->CreateDate->AdvancedSearch->SearchValue2 <> "" && $this->Command == "")
			$this->Command = "search";
		$this->CreateDate->AdvancedSearch->setSearchOperator2(Get("w_CreateDate", ""));

		// UpdateUser
		if (!$this->isAddOrEdit())
			$this->UpdateUser->AdvancedSearch->setSearchValue(Get("x_UpdateUser", Get("UpdateUser", "")));
		if ($this->UpdateUser->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->UpdateUser->AdvancedSearch->setSearchOperator(Get("z_UpdateUser", ""));

		// UpdateDate
		if (!$this->isAddOrEdit())
			$this->UpdateDate->AdvancedSearch->setSearchValue(Get("x_UpdateDate", Get("UpdateDate", "")));
		if ($this->UpdateDate->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->UpdateDate->AdvancedSearch->setSearchOperator(Get("z_UpdateDate", ""));

		// InOrOut
		if (!$this->isAddOrEdit())
			$this->InOrOut->AdvancedSearch->setSearchValue(Get("x_InOrOut", Get("InOrOut", "")));
		if ($this->InOrOut->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->InOrOut->AdvancedSearch->setSearchOperator(Get("z_InOrOut", ""));

		// FinishUnload
		if (!$this->isAddOrEdit())
			$this->FinishUnload->AdvancedSearch->setSearchValue(Get("x_FinishUnload", Get("FinishUnload", "")));
		if ($this->FinishUnload->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->FinishUnload->AdvancedSearch->setSearchOperator(Get("z_FinishUnload", ""));

		// SealNo
		if (!$this->isAddOrEdit())
			$this->SealNo->AdvancedSearch->setSearchValue(Get("x_SealNo", Get("SealNo", "")));
		if ($this->SealNo->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->SealNo->AdvancedSearch->setSearchOperator(Get("z_SealNo", ""));

		// AttachFile
		if (!$this->isAddOrEdit())
			$this->AttachFile->AdvancedSearch->setSearchValue(Get("x_AttachFile", Get("AttachFile", "")));
		if ($this->AttachFile->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->AttachFile->AdvancedSearch->setSearchOperator(Get("z_AttachFile", ""));

		// LoadingID
		if (!$this->isAddOrEdit())
			$this->LoadingID->AdvancedSearch->setSearchValue(Get("x_LoadingID", Get("LoadingID", "")));
		if ($this->LoadingID->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->LoadingID->AdvancedSearch->setSearchOperator(Get("z_LoadingID", ""));

		// Id_Type
		if (!$this->isAddOrEdit())
			$this->Id_Type->AdvancedSearch->setSearchValue(Get("x_Id_Type", Get("Id_Type", "")));
		if ($this->Id_Type->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->Id_Type->AdvancedSearch->setSearchOperator(Get("z_Id_Type", ""));
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = &$this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->ID_Route->setDbValue($row['ID_Route']);
		$this->RouteName->setDbValue($row['RouteName']);
		$this->TruckNo->setDbValue($row['TruckNo']);
		$this->DriverName->setDbValue($row['DriverName']);
		$this->DriverMobile->setDbValue($row['DriverMobile']);
		$this->InvoiceNo->setDbValue($row['InvoiceNo']);
		$this->InvoiceDate->setDbValue($row['InvoiceDate']);
		$this->CreateUser->setDbValue($row['CreateUser']);
		$this->CreateDate->setDbValue($row['CreateDate']);
		$this->UpdateUser->setDbValue($row['UpdateUser']);
		$this->UpdateDate->setDbValue($row['UpdateDate']);
		$this->InOrOut->setDbValue($row['InOrOut']);
		$this->FinishUnload->setDbValue($row['FinishUnload']);
		$this->SealNo->setDbValue($row['SealNo']);
		$this->DepartureTime->setDbValue($row['DepartureTime']);
		$this->FinishLoading->setDbValue($row['FinishLoading']);
		$this->AttachFile->Upload->DbValue = $row['AttachFile'];
		$this->AttachFile->setDbValue($this->AttachFile->Upload->DbValue);
		$this->LoadingID->setDbValue($row['LoadingID']);
		$this->Id_Type->setDbValue($row['Id_Type']);
		if (!isset($GLOBALS["vwRouteUnload_grid"]))
			$GLOBALS["vwRouteUnload_grid"] = new vwRouteUnload_grid();
		$detailFilter = $GLOBALS["vwRouteUnload"]->sqlDetailFilter_tbl_route();
		$detailFilter = str_replace("@ID_Route@", AdjustSql($this->ID_Route->DbValue, "DB"), $detailFilter);
		$GLOBALS["vwRouteUnload"]->setCurrentMasterTable("tbl_route");
		$detailFilter = $GLOBALS["vwRouteUnload"]->applyUserIDFilters($detailFilter);
		$this->vwRouteUnload_Count = $GLOBALS["vwRouteUnload"]->loadRecordCount($detailFilter);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['ID_Route'] = NULL;
		$row['RouteName'] = NULL;
		$row['TruckNo'] = NULL;
		$row['DriverName'] = NULL;
		$row['DriverMobile'] = NULL;
		$row['InvoiceNo'] = NULL;
		$row['InvoiceDate'] = NULL;
		$row['CreateUser'] = NULL;
		$row['CreateDate'] = NULL;
		$row['UpdateUser'] = NULL;
		$row['UpdateDate'] = NULL;
		$row['InOrOut'] = NULL;
		$row['FinishUnload'] = NULL;
		$row['SealNo'] = NULL;
		$row['DepartureTime'] = NULL;
		$row['FinishLoading'] = NULL;
		$row['AttachFile'] = NULL;
		$row['LoadingID'] = NULL;
		$row['Id_Type'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ID_Route")) <> "")
			$this->ID_Route->CurrentValue = $this->getKey("ID_Route"); // ID_Route
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->InlineEditUrl = $this->getInlineEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->InlineCopyUrl = $this->getInlineCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ID_Route

		$this->ID_Route->CellCssStyle = "white-space: nowrap;";

		// RouteName
		$this->RouteName->CellCssStyle = "white-space: nowrap;";

		// TruckNo
		$this->TruckNo->CellCssStyle = "white-space: nowrap;";

		// DriverName
		$this->DriverName->CellCssStyle = "white-space: nowrap;";

		// DriverMobile
		$this->DriverMobile->CellCssStyle = "white-space: nowrap;";

		// InvoiceNo
		$this->InvoiceNo->CellCssStyle = "white-space: nowrap;";

		// InvoiceDate
		$this->InvoiceDate->CellCssStyle = "white-space: nowrap;";

		// CreateUser
		$this->CreateUser->CellCssStyle = "white-space: nowrap;";

		// CreateDate
		$this->CreateDate->CellCssStyle = "white-space: nowrap;";

		// UpdateUser
		$this->UpdateUser->CellCssStyle = "white-space: nowrap;";

		// UpdateDate
		$this->UpdateDate->CellCssStyle = "white-space: nowrap;";

		// InOrOut
		$this->InOrOut->CellCssStyle = "white-space: nowrap;";

		// FinishUnload
		$this->FinishUnload->CellCssStyle = "white-space: nowrap;";

		// SealNo
		$this->SealNo->CellCssStyle = "white-space: nowrap;";

		// DepartureTime
		$this->DepartureTime->CellCssStyle = "white-space: nowrap;";

		// FinishLoading
		$this->FinishLoading->CellCssStyle = "white-space: nowrap;";

		// AttachFile
		// LoadingID
		// Id_Type

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// RouteName
			if (strval($this->RouteName->CurrentValue) <> "") {
				$this->RouteName->ViewValue = $this->RouteName->optionCaption($this->RouteName->CurrentValue);
			} else {
				$this->RouteName->ViewValue = NULL;
			}
			$this->RouteName->ViewCustomAttributes = "";

			// TruckNo
			$this->TruckNo->ViewValue = $this->TruckNo->CurrentValue;
			$this->TruckNo->ViewCustomAttributes = "";

			// DriverName
			$this->DriverName->ViewValue = $this->DriverName->CurrentValue;
			$this->DriverName->ViewCustomAttributes = "";

			// DriverMobile
			$this->DriverMobile->ViewValue = $this->DriverMobile->CurrentValue;
			$this->DriverMobile->ViewCustomAttributes = "";

			// InvoiceNo
			$this->InvoiceNo->ViewValue = $this->InvoiceNo->CurrentValue;
			$this->InvoiceNo->ViewCustomAttributes = "";

			// InvoiceDate
			$this->InvoiceDate->ViewValue = $this->InvoiceDate->CurrentValue;
			$this->InvoiceDate->ViewValue = FormatDateTime($this->InvoiceDate->ViewValue, 7);
			$this->InvoiceDate->CellCssStyle .= "text-align: center;";
			$this->InvoiceDate->ViewCustomAttributes = "";

			// CreateUser
			$this->CreateUser->ViewValue = $this->CreateUser->CurrentValue;
			$this->CreateUser->ViewCustomAttributes = "";

			// CreateDate
			$this->CreateDate->ViewValue = $this->CreateDate->CurrentValue;
			$this->CreateDate->ViewValue = FormatDateTime($this->CreateDate->ViewValue, 11);
			$this->CreateDate->CellCssStyle .= "text-align: center;";
			$this->CreateDate->ViewCustomAttributes = "";

			// FinishUnload
			if (strval($this->FinishUnload->CurrentValue) <> "") {
				$this->FinishUnload->ViewValue = $this->FinishUnload->optionCaption($this->FinishUnload->CurrentValue);
			} else {
				$this->FinishUnload->ViewValue = NULL;
			}
			$this->FinishUnload->CellCssStyle .= "text-align: center;";
			$this->FinishUnload->ViewCustomAttributes = "";

			// SealNo
			$this->SealNo->ViewValue = $this->SealNo->CurrentValue;
			$this->SealNo->ViewCustomAttributes = "";

			// AttachFile
			if (!EmptyValue($this->AttachFile->Upload->DbValue)) {
				$this->AttachFile->ViewValue = $this->AttachFile->Upload->DbValue;
			} else {
				$this->AttachFile->ViewValue = "";
			}
			$this->AttachFile->ViewCustomAttributes = "";

			// LoadingID
			$this->LoadingID->ViewValue = $this->LoadingID->CurrentValue;
			$this->LoadingID->ViewCustomAttributes = "";

			// Id_Type
			$this->Id_Type->ViewValue = $this->Id_Type->CurrentValue;
			$this->Id_Type->ViewCustomAttributes = "";

			// RouteName
			$this->RouteName->LinkCustomAttributes = "";
			$this->RouteName->HrefValue = "";
			$this->RouteName->TooltipValue = "";

			// TruckNo
			$this->TruckNo->LinkCustomAttributes = "";
			$this->TruckNo->HrefValue = "";
			$this->TruckNo->TooltipValue = "";
			if (!$this->isExport())
				$this->TruckNo->ViewValue = $this->highlightValue($this->TruckNo);

			// DriverName
			$this->DriverName->LinkCustomAttributes = "";
			$this->DriverName->HrefValue = "";
			$this->DriverName->TooltipValue = "";
			if (!$this->isExport())
				$this->DriverName->ViewValue = $this->highlightValue($this->DriverName);

			// DriverMobile
			$this->DriverMobile->LinkCustomAttributes = "";
			$this->DriverMobile->HrefValue = "";
			$this->DriverMobile->TooltipValue = "";
			if (!$this->isExport())
				$this->DriverMobile->ViewValue = $this->highlightValue($this->DriverMobile);

			// InvoiceNo
			$this->InvoiceNo->LinkCustomAttributes = "";
			$this->InvoiceNo->HrefValue = "";
			$this->InvoiceNo->TooltipValue = "";
			if (!$this->isExport())
				$this->InvoiceNo->ViewValue = $this->highlightValue($this->InvoiceNo);

			// InvoiceDate
			$this->InvoiceDate->LinkCustomAttributes = "";
			$this->InvoiceDate->HrefValue = "";
			$this->InvoiceDate->TooltipValue = "";

			// CreateUser
			$this->CreateUser->LinkCustomAttributes = "";
			$this->CreateUser->HrefValue = "";
			$this->CreateUser->TooltipValue = "";
			if (!$this->isExport())
				$this->CreateUser->ViewValue = $this->highlightValue($this->CreateUser);

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";
			$this->CreateDate->TooltipValue = "";

			// FinishUnload
			$this->FinishUnload->LinkCustomAttributes = "";
			$this->FinishUnload->HrefValue = "";
			$this->FinishUnload->TooltipValue = "";

			// SealNo
			$this->SealNo->LinkCustomAttributes = "";
			$this->SealNo->HrefValue = "";
			$this->SealNo->TooltipValue = "";
			if (!$this->isExport())
				$this->SealNo->ViewValue = $this->highlightValue($this->SealNo);

			// AttachFile
			$this->AttachFile->LinkCustomAttributes = "";
			if (!EmptyValue($this->AttachFile->Upload->DbValue)) {
				$this->AttachFile->HrefValue = GetFileUploadUrl($this->AttachFile, $this->AttachFile->Upload->DbValue); // Add prefix/suffix
				$this->AttachFile->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->AttachFile->HrefValue = FullUrl($this->AttachFile->HrefValue, "href");
			} else {
				$this->AttachFile->HrefValue = "";
			}
			$this->AttachFile->ExportHrefValue = $this->AttachFile->UploadPath . $this->AttachFile->Upload->DbValue;
			$this->AttachFile->TooltipValue = "";

			// LoadingID
			$this->LoadingID->LinkCustomAttributes = "";
			$this->LoadingID->HrefValue = "";
			$this->LoadingID->TooltipValue = "";
			if (!$this->isExport())
				$this->LoadingID->ViewValue = $this->highlightValue($this->LoadingID);

			// Id_Type
			$this->Id_Type->LinkCustomAttributes = "";
			$this->Id_Type->HrefValue = "";
			$this->Id_Type->TooltipValue = "";
			if (!$this->isExport())
				$this->Id_Type->ViewValue = $this->highlightValue($this->Id_Type);
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// RouteName
			$this->RouteName->EditAttrs["class"] = "form-control";
			$this->RouteName->EditCustomAttributes = "";
			$this->RouteName->EditValue = $this->RouteName->options(TRUE);

			// TruckNo
			$this->TruckNo->EditAttrs["class"] = "form-control";
			$this->TruckNo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->TruckNo->AdvancedSearch->SearchValue = HtmlDecode($this->TruckNo->AdvancedSearch->SearchValue);
			$this->TruckNo->EditValue = HtmlEncode($this->TruckNo->AdvancedSearch->SearchValue);
			$this->TruckNo->PlaceHolder = RemoveHtml($this->TruckNo->caption());

			// DriverName
			$this->DriverName->EditAttrs["class"] = "form-control";
			$this->DriverName->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->DriverName->AdvancedSearch->SearchValue = HtmlDecode($this->DriverName->AdvancedSearch->SearchValue);
			$this->DriverName->EditValue = HtmlEncode($this->DriverName->AdvancedSearch->SearchValue);
			$this->DriverName->PlaceHolder = RemoveHtml($this->DriverName->caption());

			// DriverMobile
			$this->DriverMobile->EditAttrs["class"] = "form-control";
			$this->DriverMobile->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->DriverMobile->AdvancedSearch->SearchValue = HtmlDecode($this->DriverMobile->AdvancedSearch->SearchValue);
			$this->DriverMobile->EditValue = HtmlEncode($this->DriverMobile->AdvancedSearch->SearchValue);
			$this->DriverMobile->PlaceHolder = RemoveHtml($this->DriverMobile->caption());

			// InvoiceNo
			$this->InvoiceNo->EditAttrs["class"] = "form-control";
			$this->InvoiceNo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->InvoiceNo->AdvancedSearch->SearchValue = HtmlDecode($this->InvoiceNo->AdvancedSearch->SearchValue);
			$this->InvoiceNo->EditValue = HtmlEncode($this->InvoiceNo->AdvancedSearch->SearchValue);
			$this->InvoiceNo->PlaceHolder = RemoveHtml($this->InvoiceNo->caption());

			// InvoiceDate
			$this->InvoiceDate->EditAttrs["class"] = "form-control";
			$this->InvoiceDate->EditCustomAttributes = "";
			$this->InvoiceDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->InvoiceDate->AdvancedSearch->SearchValue, 7), 7));
			$this->InvoiceDate->PlaceHolder = RemoveHtml($this->InvoiceDate->caption());

			// CreateUser
			$this->CreateUser->EditAttrs["class"] = "form-control";
			$this->CreateUser->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->CreateUser->AdvancedSearch->SearchValue = HtmlDecode($this->CreateUser->AdvancedSearch->SearchValue);
			$this->CreateUser->EditValue = HtmlEncode($this->CreateUser->AdvancedSearch->SearchValue);
			$this->CreateUser->PlaceHolder = RemoveHtml($this->CreateUser->caption());

			// CreateDate
			$this->CreateDate->EditAttrs["class"] = "form-control";
			$this->CreateDate->EditCustomAttributes = "";
			$this->CreateDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->CreateDate->AdvancedSearch->SearchValue, 11), 11));
			$this->CreateDate->PlaceHolder = RemoveHtml($this->CreateDate->caption());
			$this->CreateDate->EditAttrs["class"] = "form-control";
			$this->CreateDate->EditCustomAttributes = "";
			$this->CreateDate->EditValue2 = HtmlEncode(FormatDateTime(UnFormatDateTime($this->CreateDate->AdvancedSearch->SearchValue2, 11), 11));
			$this->CreateDate->PlaceHolder = RemoveHtml($this->CreateDate->caption());

			// FinishUnload
			$this->FinishUnload->EditAttrs["class"] = "form-control";
			$this->FinishUnload->EditCustomAttributes = "";
			$this->FinishUnload->EditValue = $this->FinishUnload->options(TRUE);

			// SealNo
			$this->SealNo->EditAttrs["class"] = "form-control";
			$this->SealNo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->SealNo->AdvancedSearch->SearchValue = HtmlDecode($this->SealNo->AdvancedSearch->SearchValue);
			$this->SealNo->EditValue = HtmlEncode($this->SealNo->AdvancedSearch->SearchValue);
			$this->SealNo->PlaceHolder = RemoveHtml($this->SealNo->caption());

			// AttachFile
			$this->AttachFile->EditAttrs["class"] = "form-control";
			$this->AttachFile->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->AttachFile->AdvancedSearch->SearchValue = HtmlDecode($this->AttachFile->AdvancedSearch->SearchValue);
			$this->AttachFile->EditValue = HtmlEncode($this->AttachFile->AdvancedSearch->SearchValue);
			$this->AttachFile->PlaceHolder = RemoveHtml($this->AttachFile->caption());

			// LoadingID
			$this->LoadingID->EditAttrs["class"] = "form-control";
			$this->LoadingID->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->LoadingID->AdvancedSearch->SearchValue = HtmlDecode($this->LoadingID->AdvancedSearch->SearchValue);
			$this->LoadingID->EditValue = HtmlEncode($this->LoadingID->AdvancedSearch->SearchValue);
			$this->LoadingID->PlaceHolder = RemoveHtml($this->LoadingID->caption());

			// Id_Type
			$this->Id_Type->EditAttrs["class"] = "form-control";
			$this->Id_Type->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Id_Type->AdvancedSearch->SearchValue = HtmlDecode($this->Id_Type->AdvancedSearch->SearchValue);
			$this->Id_Type->EditValue = HtmlEncode($this->Id_Type->AdvancedSearch->SearchValue);
			$this->Id_Type->PlaceHolder = RemoveHtml($this->Id_Type->caption());
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
		if (!CheckEuroDate($this->CreateDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->CreateDate->errorMessage());
		}
		if (!CheckEuroDate($this->CreateDate->AdvancedSearch->SearchValue2)) {
			AddMessage($SearchError, $this->CreateDate->errorMessage());
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
		$this->RouteName->AdvancedSearch->load();
		$this->TruckNo->AdvancedSearch->load();
		$this->DriverName->AdvancedSearch->load();
		$this->DriverMobile->AdvancedSearch->load();
		$this->InvoiceNo->AdvancedSearch->load();
		$this->InvoiceDate->AdvancedSearch->load();
		$this->CreateUser->AdvancedSearch->load();
		$this->CreateDate->AdvancedSearch->load();
		$this->UpdateUser->AdvancedSearch->load();
		$this->UpdateDate->AdvancedSearch->load();
		$this->InOrOut->AdvancedSearch->load();
		$this->FinishUnload->AdvancedSearch->load();
		$this->SealNo->AdvancedSearch->load();
		$this->AttachFile->AdvancedSearch->load();
		$this->LoadingID->AdvancedSearch->load();
		$this->Id_Type->AdvancedSearch->load();
	}

	// Build export filter for selected records
	protected function buildExportSelectedFilter()
	{
		global $Language;
		$wrkFilter = "";
		if ($this->isExport())
			$wrkFilter = $this->getFilterFromRecordKeys();
		return $wrkFilter;
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"javascript:void(0);\" class=\" ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"ew.export(document.ftbl_routelist,'" . CurrentPageName() . "','excel',true,true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"javascript:void(0);\" class=\" ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"ew.export(document.ftbl_routelist,'" . CurrentPageName() . "','excel',false,true);\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"javascript:void(0);\" class=\" ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"ew.export(document.ftbl_routelist,'" . CurrentPageName() . "','word',true,true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"javascript:void(0);\" class=\" ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"ew.export(document.ftbl_routelist,'" . CurrentPageName() . "','word',false,true);\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"javascript:void(0);\" class=\" ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"ew.export(document.ftbl_routelist,'" . CurrentPageName() . "','pdf',true,true);\">" . $Language->phrase("ExportToPDF") . "</a>";
			else
				return "<a href=\"javascript:void(0);\" class=\" ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"ew.export(document.ftbl_routelist,'" . CurrentPageName() . "','pdf',false,true);\">" . $Language->phrase("ExportToPDF") . "</a>";
		} elseif (SameText($type, "html")) {
			return "<a href=\"javascript:void(0);\" class=\" ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" onclick=\"ew.export(document.ftbl_routelist,'" . CurrentPageName() . "','html',false,true);\">" . $Language->phrase("ExportToHtml") . "</a>";
		} elseif (SameText($type, "xml")) {
			return "<a href=\"javascript:void(0);\" class=\" ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" onclick=\"ew.export(document.ftbl_routelist,'" . CurrentPageName() . "','xml',false,true);\">" . $Language->phrase("ExportToXml") . "</a>";
		} elseif (SameText($type, "csv")) {
			return "<a href=\"javascript:void(0);\" class=\" ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" onclick=\"ew.export(document.ftbl_routelist,'" . CurrentPageName() . "','csv',false,true);\">" . $Language->phrase("ExportToCsv") . "</a>";
		} elseif (SameText($type, "print")) {
			return "<a href=\"javascript:void(0);\" class=\" ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" onclick=\"ew.export(document.ftbl_routelist,'" . CurrentPageName() . "','print',false,true);\">" . $Language->phrase("PrinterFriendly") . "</a>";
		}
	}

	// Set up export options
	protected function setupExportOptions()
	{
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->add("print");
		$item->Body = $this->getExportTag("print");
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->add("excel");
		$item->Body = $this->getExportTag("excel");
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->add("word");
		$item->Body = $this->getExportTag("word");
		$item->Visible = FALSE;

		// Export to Html
		$item = &$this->ExportOptions->add("html");
		$item->Body = $this->getExportTag("html");
		$item->Visible = FALSE;

		// Export to Xml
		$item = &$this->ExportOptions->add("xml");
		$item->Body = $this->getExportTag("xml");
		$item->Visible = FALSE;

		// Export to Csv
		$item = &$this->ExportOptions->add("csv");
		$item->Body = $this->getExportTag("csv");
		$item->Visible = FALSE;

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = $this->getExportTag("pdf");
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$url = "";
		$item->Body = "<button id=\"emf_tbl_route\" class=\"ew-export-link ew-email\" title=\"" . $Language->phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->phrase("ExportToEmailText") . "\" onclick=\"ew.emailDialogShow({lnk:'emf_tbl_route',hdr:ew.language.phrase('ExportToEmailText'),f:document.ftbl_routelist,sel:true" . $url . "});\">" . $Language->phrase("ExportToEmail") . "</button>";
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseDropDownButton = FALSE;
		if ($this->ExportOptions->UseButtonGroup && IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	/**
	 * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	 *
	 * @param boolean $return Return the data rather than output it
	 * @return mixed 
	 */
	public function exportData($return = FALSE)
	{
		global $Language;
		$utf8 = SameText(PROJECT_CHARSET, "utf-8");
		$selectLimit = $this->UseSelectLimit;

		// Load recordset
		if ($selectLimit) {
			$this->TotalRecs = $this->listRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->loadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($this->ExportAll) {
			set_time_limit(EXPORT_ALL_TIME_LIMIT);
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->setupStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs <= 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($selectLimit)
			$rs = $this->loadRecordset($this->StartRec - 1, $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs);
		$this->ExportDoc = GetExportDocument($this, "h");
		$doc = &$this->ExportDoc;
		if (!$doc)
			$this->setFailureMessage($Language->phrase("ExportClassNotFound")); // Export class not found
		if (!$rs || !$doc) {
			RemoveHeader("Content-Type"); // Remove header
			RemoveHeader("Content-Disposition");
			$this->showMessage();
			return;
		}
		if ($selectLimit) {
			$this->StartRec = 1;
			$this->StopRec = $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs;
		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		$doc->Text .= $header;
		$this->exportDocument($doc, $rs, $this->StartRec, $this->StopRec, "");
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		$doc->Text .= $footer;

		// Close recordset
		$rs->close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$doc->exportHeaderAndFooter();

		// Clean output buffer (without destroying output buffer)
		$buffer = ob_get_contents(); // Save the output buffer
		if (!DEBUG_ENABLED && $buffer)
			ob_clean();

		// Write debug message if enabled
		if (DEBUG_ENABLED && !$this->isExport("pdf"))
			echo GetDebugMessage();

		// Output data
		if ($this->isExport("email")) {

			// Export-to-email disabled
		} else {
			$doc->export();
			if ($return) {
				RemoveHeader("Content-Type"); // Remove header
				RemoveHeader("Content-Disposition");
				$content = ob_get_contents();
				if ($content)
					ob_clean();
				if ($buffer)
					echo $buffer; // Resume the output buffer
				return $content;
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}

	// Page Importing event
	function Page_Importing($reader, &$options) {

		//var_dump($reader); // Import data reader
		//var_dump($options); // Show all options for importing
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Row Import event
	function Row_Import(&$row, $cnt) {

		//echo $cnt; // Import record count
		//var_dump($row); // Import row
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Page Imported event
	function Page_Imported($reader, $results) {

		//var_dump($reader); // Import data reader
		//var_dump($results); // Import results

	}
}
?>