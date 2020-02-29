<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Page class
 */
class tbl_stock_list extends tbl_stock
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{004E2122-9CCA-46AA-835C-0778C5A080BC}";

	// Table name
	public $TableName = 'tbl_stock';

	// Page object name
	public $PageObjName = "tbl_stock_list";

	// Grid form hidden field names
	public $FormName = "ftbl_stocklist";
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

		// Table object (tbl_stock)
		if (!isset($GLOBALS["tbl_stock"]) || get_class($GLOBALS["tbl_stock"]) == PROJECT_NAMESPACE . "tbl_stock") {
			$GLOBALS["tbl_stock"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_stock"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->AddUrl = "tbl_stockadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "tbl_stockdelete.php";
		$this->MultiUpdateUrl = "tbl_stockupdate.php";
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (tbl_user)
		if (!isset($GLOBALS['tbl_user']))
			$GLOBALS['tbl_user'] = new tbl_user();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_stock');

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
		$this->FilterOptions->TagClassName = "ew-filter-option ftbl_stocklistsrch";

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
		global $EXPORT, $tbl_stock;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_stock);
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
			$key .= @$ar['ID_Stock'];
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
			$this->ID_Stock->Visible = FALSE;
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

		// Create form object
		$CurrentForm = new HttpForm();

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
		$this->ID_Stock->Visible = FALSE;
		$this->PalletID->setVisibility();
		$this->Code->setVisibility();
		$this->IdType->setVisibility();
		$this->ID_Location->setVisibility();
		$this->Pcs_RemainPicking->setVisibility();
		$this->PCS->Visible = FALSE;
		$this->MFG->setVisibility();
		$this->DateIn->Visible = FALSE;
		$this->Imp_id->Visible = FALSE;
		$this->User_ID->Visible = FALSE;
		$this->Note_PalletId->setVisibility();
		$this->CreateUser->setVisibility();
		$this->CreateDate->setVisibility();
		$this->UpdateUser->Visible = FALSE;
		$this->UpdateDate->Visible = FALSE;
		$this->StatusPicking->Visible = FALSE;
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
		$this->setupLookupOptions($this->IdType);
		$this->setupLookupOptions($this->ID_Location);

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

			// Check QueryString parameters
			if (Get("action") !== NULL) {
				$this->CurrentAction = Get("action");

				// Clear inline mode
				if ($this->isCancel())
					$this->clearInlineMode();

				// Switch to grid edit mode
				if ($this->isGridEdit())
					$this->gridEditMode();
			} else {
				if (Post("action") !== NULL) {
					$this->CurrentAction = Post("action"); // Get action

					// Grid Update
					if (($this->isGridUpdate() || $this->isGridOverwrite()) && @$_SESSION[SESSION_INLINE_MODE] == "gridedit") {
						if ($this->validateGridForm()) {
							$gridUpdate = $this->gridUpdate();
						} else {
							$gridUpdate = FALSE;
							$this->setFailureMessage($FormError);
						}
						if ($gridUpdate) {
						} else {
							$this->EventCancelled = TRUE;
							$this->gridEditMode(); // Stay in Grid edit mode
						}
					}
				} elseif (@$_SESSION[SESSION_INLINE_MODE] == "gridedit") { // Previously in grid edit mode
					if (Get(TABLE_START_REC) !== NULL || Get(TABLE_PAGE_NO) !== NULL) // Stay in grid edit mode if paging
						$this->gridEditMode();
					else // Reset grid edit
						$this->clearInlineMode();
				}
			}

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

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->isGridAdd() || $this->isGridEdit()) {
					$item = &$this->ListOptions->getItem("griddelete");
					if ($item)
						$item->Visible = TRUE;
				}
			}

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

	// Exit inline mode
	protected function clearInlineMode()
	{
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Edit mode
	protected function gridEditMode()
	{
		$this->CurrentAction = "gridedit";
		$_SESSION[SESSION_INLINE_MODE] = "gridedit";
		$this->hideFieldsForAddEdit();
	}

	// Perform update to grid
	public function gridUpdate()
	{
		global $Language, $CurrentForm, $FormError;
		$gridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->buildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sql)) {
			$rsold = $rs->getRows();
			$rs->close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}

		// Begin transaction
		$conn->beginTrans();
		if ($this->AuditTrailOnEdit)
			$this->writeAuditTrailDummy($Language->phrase("BatchUpdateBegin")); // Batch update begin
		$key = "";

		// Update row index and get row key
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$CurrentForm->Index = $rowindex;
			$rowkey = strval($CurrentForm->getValue($this->FormKeyName));
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction <> "insertdelete") { // Skip insert then deleted rows
				$this->loadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$gridUpdate = $this->setupKeyValues($rowkey); // Set up key values
				} else {
					$gridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->emptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($gridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->getRecordFilter();
						$gridUpdate = $this->deleteRows(); // Delete this row
					} else if (!$this->validateForm()) {
						$gridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($FormError);
					} else {
						if ($rowaction == "insert") {
							$gridUpdate = $this->addRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$gridUpdate = $this->editRow(); // Update this row
							}
						} // End update
					}
				}
				if ($gridUpdate) {
					if ($key <> "")
						$key .= ", ";
					$key .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($gridUpdate) {
			$conn->commitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateSuccess")); // Batch update success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Set up update success message
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			$conn->rollbackTrans(); // Rollback transaction
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateRollback")); // Batch update rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("UpdateFailed")); // Set update failed message
		}
		return $gridUpdate;
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
			$this->ID_Stock->setFormValue($arKeyFlds[0]);
			if (!is_numeric($this->ID_Stock->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_PalletID") && $CurrentForm->hasValue("o_PalletID") && $this->PalletID->CurrentValue <> $this->PalletID->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Code") && $CurrentForm->hasValue("o_Code") && $this->Code->CurrentValue <> $this->Code->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_IdType") && $CurrentForm->hasValue("o_IdType") && $this->IdType->CurrentValue <> $this->IdType->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ID_Location") && $CurrentForm->hasValue("o_ID_Location") && $this->ID_Location->CurrentValue <> $this->ID_Location->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Pcs_RemainPicking") && $CurrentForm->hasValue("o_Pcs_RemainPicking") && $this->Pcs_RemainPicking->CurrentValue <> $this->Pcs_RemainPicking->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_MFG") && $CurrentForm->hasValue("o_MFG") && $this->MFG->CurrentValue <> $this->MFG->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Note_PalletId") && $CurrentForm->hasValue("o_Note_PalletId") && $this->Note_PalletId->CurrentValue <> $this->Note_PalletId->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_CreateUser") && $CurrentForm->hasValue("o_CreateUser") && $this->CreateUser->CurrentValue <> $this->CreateUser->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_CreateDate") && $CurrentForm->hasValue("o_CreateDate") && $this->CreateDate->CurrentValue <> $this->CreateDate->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	public function validateGridForm()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else if (!$this->validateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	public function getGridFormValues()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = array();

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->getFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	public function restoreCurrentRowFormValues($idx)
	{
		global $CurrentForm;

		// Get row based on current index
		$CurrentForm->Index = $idx;
		$this->loadFormValues(); // Load form values
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";
		$filterList = Concat($filterList, $this->PalletID->AdvancedSearch->toJson(), ","); // Field PalletID
		$filterList = Concat($filterList, $this->Code->AdvancedSearch->toJson(), ","); // Field Code
		$filterList = Concat($filterList, $this->IdType->AdvancedSearch->toJson(), ","); // Field IdType
		$filterList = Concat($filterList, $this->ID_Location->AdvancedSearch->toJson(), ","); // Field ID_Location
		$filterList = Concat($filterList, $this->MFG->AdvancedSearch->toJson(), ","); // Field MFG
		$filterList = Concat($filterList, $this->CreateDate->AdvancedSearch->toJson(), ","); // Field CreateDate
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
			$UserProfile->setSearchFilters(CurrentUserName(), "ftbl_stocklistsrch", $filters);
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

		// Field PalletID
		$this->PalletID->AdvancedSearch->SearchValue = @$filter["x_PalletID"];
		$this->PalletID->AdvancedSearch->SearchOperator = @$filter["z_PalletID"];
		$this->PalletID->AdvancedSearch->SearchCondition = @$filter["v_PalletID"];
		$this->PalletID->AdvancedSearch->SearchValue2 = @$filter["y_PalletID"];
		$this->PalletID->AdvancedSearch->SearchOperator2 = @$filter["w_PalletID"];
		$this->PalletID->AdvancedSearch->save();

		// Field Code
		$this->Code->AdvancedSearch->SearchValue = @$filter["x_Code"];
		$this->Code->AdvancedSearch->SearchOperator = @$filter["z_Code"];
		$this->Code->AdvancedSearch->SearchCondition = @$filter["v_Code"];
		$this->Code->AdvancedSearch->SearchValue2 = @$filter["y_Code"];
		$this->Code->AdvancedSearch->SearchOperator2 = @$filter["w_Code"];
		$this->Code->AdvancedSearch->save();

		// Field IdType
		$this->IdType->AdvancedSearch->SearchValue = @$filter["x_IdType"];
		$this->IdType->AdvancedSearch->SearchOperator = @$filter["z_IdType"];
		$this->IdType->AdvancedSearch->SearchCondition = @$filter["v_IdType"];
		$this->IdType->AdvancedSearch->SearchValue2 = @$filter["y_IdType"];
		$this->IdType->AdvancedSearch->SearchOperator2 = @$filter["w_IdType"];
		$this->IdType->AdvancedSearch->save();

		// Field ID_Location
		$this->ID_Location->AdvancedSearch->SearchValue = @$filter["x_ID_Location"];
		$this->ID_Location->AdvancedSearch->SearchOperator = @$filter["z_ID_Location"];
		$this->ID_Location->AdvancedSearch->SearchCondition = @$filter["v_ID_Location"];
		$this->ID_Location->AdvancedSearch->SearchValue2 = @$filter["y_ID_Location"];
		$this->ID_Location->AdvancedSearch->SearchOperator2 = @$filter["w_ID_Location"];
		$this->ID_Location->AdvancedSearch->save();

		// Field MFG
		$this->MFG->AdvancedSearch->SearchValue = @$filter["x_MFG"];
		$this->MFG->AdvancedSearch->SearchOperator = @$filter["z_MFG"];
		$this->MFG->AdvancedSearch->SearchCondition = @$filter["v_MFG"];
		$this->MFG->AdvancedSearch->SearchValue2 = @$filter["y_MFG"];
		$this->MFG->AdvancedSearch->SearchOperator2 = @$filter["w_MFG"];
		$this->MFG->AdvancedSearch->save();

		// Field CreateDate
		$this->CreateDate->AdvancedSearch->SearchValue = @$filter["x_CreateDate"];
		$this->CreateDate->AdvancedSearch->SearchOperator = @$filter["z_CreateDate"];
		$this->CreateDate->AdvancedSearch->SearchCondition = @$filter["v_CreateDate"];
		$this->CreateDate->AdvancedSearch->SearchValue2 = @$filter["y_CreateDate"];
		$this->CreateDate->AdvancedSearch->SearchOperator2 = @$filter["w_CreateDate"];
		$this->CreateDate->AdvancedSearch->save();
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
		$this->buildSearchSql($where, $this->PalletID, $default, FALSE); // PalletID
		$this->buildSearchSql($where, $this->Code, $default, FALSE); // Code
		$this->buildSearchSql($where, $this->IdType, $default, FALSE); // IdType
		$this->buildSearchSql($where, $this->ID_Location, $default, FALSE); // ID_Location
		$this->buildSearchSql($where, $this->MFG, $default, FALSE); // MFG
		$this->buildSearchSql($where, $this->CreateDate, $default, FALSE); // CreateDate

		// Set up search parm
		if (!$default && $where <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->PalletID->AdvancedSearch->save(); // PalletID
			$this->Code->AdvancedSearch->save(); // Code
			$this->IdType->AdvancedSearch->save(); // IdType
			$this->ID_Location->AdvancedSearch->save(); // ID_Location
			$this->MFG->AdvancedSearch->save(); // MFG
			$this->CreateDate->AdvancedSearch->save(); // CreateDate
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
		$this->buildBasicSearchSql($where, $this->PalletID, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Code, $arKeywords, $type);
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
		if ($this->PalletID->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Code->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->IdType->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ID_Location->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->MFG->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->CreateDate->AdvancedSearch->issetSession())
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
		$this->PalletID->AdvancedSearch->unsetSession();
		$this->Code->AdvancedSearch->unsetSession();
		$this->IdType->AdvancedSearch->unsetSession();
		$this->ID_Location->AdvancedSearch->unsetSession();
		$this->MFG->AdvancedSearch->unsetSession();
		$this->CreateDate->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->PalletID->AdvancedSearch->load();
		$this->Code->AdvancedSearch->load();
		$this->IdType->AdvancedSearch->load();
		$this->ID_Location->AdvancedSearch->load();
		$this->MFG->AdvancedSearch->load();
		$this->CreateDate->AdvancedSearch->load();
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
			$this->updateSort($this->PalletID, $ctrl); // PalletID
			$this->updateSort($this->Code, $ctrl); // Code
			$this->updateSort($this->IdType, $ctrl); // IdType
			$this->updateSort($this->ID_Location, $ctrl); // ID_Location
			$this->updateSort($this->Pcs_RemainPicking, $ctrl); // Pcs_RemainPicking
			$this->updateSort($this->MFG, $ctrl); // MFG
			$this->updateSort($this->Note_PalletId, $ctrl); // Note_PalletId
			$this->updateSort($this->CreateUser, $ctrl); // CreateUser
			$this->updateSort($this->CreateDate, $ctrl); // CreateDate
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
				$this->ID_Location->setSort("ASC");
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
				$this->setSessionOrderByList($orderBy);
				$this->PalletID->setSort("");
				$this->Code->setSort("");
				$this->IdType->setSort("");
				$this->ID_Location->setSort("");
				$this->Pcs_RemainPicking->setSort("");
				$this->MFG->setSort("");
				$this->Note_PalletId->setSort("");
				$this->CreateUser->setSort("");
				$this->CreateDate->setSort("");
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

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

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

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode <> "view") {
			$CurrentForm->Index = $this->RowIndex;
			$actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$keyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $CurrentForm->getValue($this->FormKeyName);
				$this->setupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->isGridAdd() || $this->isGridEdit()) {
				$options = &$this->ListOptions;
				$options->UseButtonGroup = TRUE; // Use button group for grid delete button
				$opt = &$options->Items["griddelete"];
				if (!$Security->canDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$opt->Body = "&nbsp;";
				} else {
					$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
				}
			}
		}

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

		// "checkbox"
		$opt = &$this->ListOptions->Items["checkbox"];
		$opt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ew-multi-select\" value=\"" . HtmlEncode($this->ID_Stock->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\">";
		if ($this->isGridEdit() && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->ID_Stock->CurrentValue . "\">";
		}
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
		$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->canAdd());

		// Add grid edit
		$option = $options["addedit"];
		$item = &$option->add("gridedit");
		$item->Body = "<a class=\"ew-add-edit ew-grid-edit\" title=\"" . HtmlTitle($Language->phrase("GridEditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridEditLink")) . "\" href=\"" . HtmlEncode($this->GridEditUrl) . "\">" . $Language->phrase("GridEditLink") . "</a>";
		$item->Visible = ($this->GridEditUrl <> "" && $Security->canEdit());
		$option = $options["action"];

		// Add multi delete
		$item = &$option->add("multidelete");
		$item->Body = "<a class=\"ew-action ew-multi-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" href=\"\" onclick=\"ew.submitAction(event,{f:document.ftbl_stocklist,url:'" . $this->MultiDeleteUrl . "',data:{action:'show'}});return false;\">" . $Language->phrase("DeleteSelectedLink") . "</a>";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"ftbl_stocklistsrch\" href=\"#\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"ftbl_stocklistsrch\" href=\"#\">" . $Language->phrase("DeleteFilter") . "</a>";
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
		if (!$this->isGridAdd() && !$this->isGridEdit()) { // Not grid add/edit mode
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({f:document.ftbl_stocklist}," . $listaction->toJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		} else { // Grid add/edit mode

			// Hide all options first
			foreach ($options as &$option)
				$option->hideAllOptions();
			if ($this->isGridEdit()) {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$item = &$option->add("addblankrow");
					$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->canAdd();
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;
					$item = &$option->add("gridsave");
					$item->Body = "<a class=\"ew-action ew-grid-save\" title=\"" . HtmlTitle($Language->phrase("GridSaveLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridSaveLink")) . "\" href=\"\" onclick=\"return ew.forms(this).submit('" . $this->pageName() . "');\">" . $Language->phrase("GridSaveLink") . "</a>";
					$item = &$option->add("gridcancel");
					$item->Body = "<a class=\"ew-action ew-grid-cancel\" title=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" href=\"" . $this->CancelUrl . "\">" . $Language->phrase("GridCancelLink") . "</a>";
			}
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"ftbl_stocklistsrch\">" . $Language->phrase("SearchLink") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<button type=\"button\" class=\"btn btn-default ew-highlight active\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"ftbl_stocklistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</button>";
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

	// Load default values
	protected function loadDefaultValues()
	{
		$this->ID_Stock->CurrentValue = NULL;
		$this->ID_Stock->OldValue = $this->ID_Stock->CurrentValue;
		$this->PalletID->CurrentValue = NULL;
		$this->PalletID->OldValue = $this->PalletID->CurrentValue;
		$this->Code->CurrentValue = NULL;
		$this->Code->OldValue = $this->Code->CurrentValue;
		$this->IdType->CurrentValue = NULL;
		$this->IdType->OldValue = $this->IdType->CurrentValue;
		$this->ID_Location->CurrentValue = NULL;
		$this->ID_Location->OldValue = $this->ID_Location->CurrentValue;
		$this->Pcs_RemainPicking->CurrentValue = NULL;
		$this->Pcs_RemainPicking->OldValue = $this->Pcs_RemainPicking->CurrentValue;
		$this->PCS->CurrentValue = NULL;
		$this->PCS->OldValue = $this->PCS->CurrentValue;
		$this->MFG->CurrentValue = NULL;
		$this->MFG->OldValue = $this->MFG->CurrentValue;
		$this->DateIn->CurrentValue = NULL;
		$this->DateIn->OldValue = $this->DateIn->CurrentValue;
		$this->Imp_id->CurrentValue = NULL;
		$this->Imp_id->OldValue = $this->Imp_id->CurrentValue;
		$this->User_ID->CurrentValue = NULL;
		$this->User_ID->OldValue = $this->User_ID->CurrentValue;
		$this->Note_PalletId->CurrentValue = NULL;
		$this->Note_PalletId->OldValue = $this->Note_PalletId->CurrentValue;
		$this->CreateUser->CurrentValue = CurrentUserName();
		$this->CreateUser->OldValue = $this->CreateUser->CurrentValue;
		$this->CreateDate->CurrentValue = CurrentDateTime();
		$this->CreateDate->OldValue = $this->CreateDate->CurrentValue;
		$this->UpdateUser->CurrentValue = NULL;
		$this->UpdateUser->OldValue = $this->UpdateUser->CurrentValue;
		$this->UpdateDate->CurrentValue = NULL;
		$this->UpdateDate->OldValue = $this->UpdateDate->CurrentValue;
		$this->StatusPicking->CurrentValue = NULL;
		$this->StatusPicking->OldValue = $this->StatusPicking->CurrentValue;
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
		// PalletID

		if (!$this->isAddOrEdit())
			$this->PalletID->AdvancedSearch->setSearchValue(Get("x_PalletID", Get("PalletID", "")));
		if ($this->PalletID->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->PalletID->AdvancedSearch->setSearchOperator(Get("z_PalletID", ""));

		// Code
		if (!$this->isAddOrEdit())
			$this->Code->AdvancedSearch->setSearchValue(Get("x_Code", Get("Code", "")));
		if ($this->Code->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->Code->AdvancedSearch->setSearchOperator(Get("z_Code", ""));

		// IdType
		if (!$this->isAddOrEdit())
			$this->IdType->AdvancedSearch->setSearchValue(Get("x_IdType", Get("IdType", "")));
		if ($this->IdType->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->IdType->AdvancedSearch->setSearchOperator(Get("z_IdType", ""));

		// ID_Location
		if (!$this->isAddOrEdit())
			$this->ID_Location->AdvancedSearch->setSearchValue(Get("x_ID_Location", Get("ID_Location", "")));
		if ($this->ID_Location->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->ID_Location->AdvancedSearch->setSearchOperator(Get("z_ID_Location", ""));

		// MFG
		if (!$this->isAddOrEdit())
			$this->MFG->AdvancedSearch->setSearchValue(Get("x_MFG", Get("MFG", "")));
		if ($this->MFG->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->MFG->AdvancedSearch->setSearchOperator(Get("z_MFG", ""));
		$this->MFG->AdvancedSearch->setSearchCondition(Get("v_MFG", ""));
		$this->MFG->AdvancedSearch->setSearchValue2(Get("y_MFG", ""));
		if ($this->MFG->AdvancedSearch->SearchValue2 <> "" && $this->Command == "")
			$this->Command = "search";
		$this->MFG->AdvancedSearch->setSearchOperator2(Get("w_MFG", ""));

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
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'PalletID' first before field var 'x_PalletID'
		$val = $CurrentForm->hasValue("PalletID") ? $CurrentForm->getValue("PalletID") : $CurrentForm->getValue("x_PalletID");
		if (!$this->PalletID->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PalletID->Visible = FALSE; // Disable update for API request
			else
				$this->PalletID->setFormValue($val);
		}

		// Check field name 'Code' first before field var 'x_Code'
		$val = $CurrentForm->hasValue("Code") ? $CurrentForm->getValue("Code") : $CurrentForm->getValue("x_Code");
		if (!$this->Code->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Code->Visible = FALSE; // Disable update for API request
			else
				$this->Code->setFormValue($val);
		}

		// Check field name 'IdType' first before field var 'x_IdType'
		$val = $CurrentForm->hasValue("IdType") ? $CurrentForm->getValue("IdType") : $CurrentForm->getValue("x_IdType");
		if (!$this->IdType->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->IdType->Visible = FALSE; // Disable update for API request
			else
				$this->IdType->setFormValue($val);
		}

		// Check field name 'ID_Location' first before field var 'x_ID_Location'
		$val = $CurrentForm->hasValue("ID_Location") ? $CurrentForm->getValue("ID_Location") : $CurrentForm->getValue("x_ID_Location");
		if (!$this->ID_Location->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Location->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Location->setFormValue($val);
		}

		// Check field name 'Pcs_RemainPicking' first before field var 'x_Pcs_RemainPicking'
		$val = $CurrentForm->hasValue("Pcs_RemainPicking") ? $CurrentForm->getValue("Pcs_RemainPicking") : $CurrentForm->getValue("x_Pcs_RemainPicking");
		if (!$this->Pcs_RemainPicking->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Pcs_RemainPicking->Visible = FALSE; // Disable update for API request
			else
				$this->Pcs_RemainPicking->setFormValue($val);
		}

		// Check field name 'MFG' first before field var 'x_MFG'
		$val = $CurrentForm->hasValue("MFG") ? $CurrentForm->getValue("MFG") : $CurrentForm->getValue("x_MFG");
		if (!$this->MFG->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->MFG->Visible = FALSE; // Disable update for API request
			else
				$this->MFG->setFormValue($val);
			$this->MFG->CurrentValue = UnFormatDateTime($this->MFG->CurrentValue, 7);
		}

		// Check field name 'Note_PalletId' first before field var 'x_Note_PalletId'
		$val = $CurrentForm->hasValue("Note_PalletId") ? $CurrentForm->getValue("Note_PalletId") : $CurrentForm->getValue("x_Note_PalletId");
		if (!$this->Note_PalletId->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Note_PalletId->Visible = FALSE; // Disable update for API request
			else
				$this->Note_PalletId->setFormValue($val);
		}

		// Check field name 'CreateUser' first before field var 'x_CreateUser'
		$val = $CurrentForm->hasValue("CreateUser") ? $CurrentForm->getValue("CreateUser") : $CurrentForm->getValue("x_CreateUser");
		if (!$this->CreateUser->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CreateUser->Visible = FALSE; // Disable update for API request
			else
				$this->CreateUser->setFormValue($val);
		}

		// Check field name 'CreateDate' first before field var 'x_CreateDate'
		$val = $CurrentForm->hasValue("CreateDate") ? $CurrentForm->getValue("CreateDate") : $CurrentForm->getValue("x_CreateDate");
		if (!$this->CreateDate->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CreateDate->Visible = FALSE; // Disable update for API request
			else
				$this->CreateDate->setFormValue($val);
			$this->CreateDate->CurrentValue = UnFormatDateTime($this->CreateDate->CurrentValue, 11);
		}

		// Check field name 'ID_Stock' first before field var 'x_ID_Stock'
		$val = $CurrentForm->hasValue("ID_Stock") ? $CurrentForm->getValue("ID_Stock") : $CurrentForm->getValue("x_ID_Stock");
		if (!$this->ID_Stock->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->ID_Stock->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->ID_Stock->CurrentValue = $this->ID_Stock->FormValue;
		$this->PalletID->CurrentValue = $this->PalletID->FormValue;
		$this->Code->CurrentValue = $this->Code->FormValue;
		$this->IdType->CurrentValue = $this->IdType->FormValue;
		$this->ID_Location->CurrentValue = $this->ID_Location->FormValue;
		$this->Pcs_RemainPicking->CurrentValue = $this->Pcs_RemainPicking->FormValue;
		$this->MFG->CurrentValue = $this->MFG->FormValue;
		$this->MFG->CurrentValue = UnFormatDateTime($this->MFG->CurrentValue, 7);
		$this->Note_PalletId->CurrentValue = $this->Note_PalletId->FormValue;
		$this->CreateUser->CurrentValue = $this->CreateUser->FormValue;
		$this->CreateDate->CurrentValue = $this->CreateDate->FormValue;
		$this->CreateDate->CurrentValue = UnFormatDateTime($this->CreateDate->CurrentValue, 11);
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
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderByList())]);
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
			if (!$this->EventCancelled)
				$this->HashValue = $this->getRowHash($rs); // Get hash value for record
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
		$this->ID_Stock->setDbValue($row['ID_Stock']);
		$this->PalletID->setDbValue($row['PalletID']);
		$this->Code->setDbValue($row['Code']);
		$this->IdType->setDbValue($row['IdType']);
		$this->ID_Location->setDbValue($row['ID_Location']);
		if (array_key_exists('EV__ID_Location', $rs->fields)) {
			$this->ID_Location->VirtualValue = $rs->fields('EV__ID_Location'); // Set up virtual field value
		} else {
			$this->ID_Location->VirtualValue = ""; // Clear value
		}
		$this->Pcs_RemainPicking->setDbValue($row['Pcs_RemainPicking']);
		$this->PCS->setDbValue($row['PCS']);
		$this->MFG->setDbValue($row['MFG']);
		$this->DateIn->setDbValue($row['DateIn']);
		$this->Imp_id->setDbValue($row['Imp_id']);
		$this->User_ID->setDbValue($row['User_ID']);
		$this->Note_PalletId->setDbValue($row['Note_PalletId']);
		$this->CreateUser->setDbValue($row['CreateUser']);
		$this->CreateDate->setDbValue($row['CreateDate']);
		$this->UpdateUser->setDbValue($row['UpdateUser']);
		$this->UpdateDate->setDbValue($row['UpdateDate']);
		$this->StatusPicking->setDbValue($row['StatusPicking']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ID_Stock'] = $this->ID_Stock->CurrentValue;
		$row['PalletID'] = $this->PalletID->CurrentValue;
		$row['Code'] = $this->Code->CurrentValue;
		$row['IdType'] = $this->IdType->CurrentValue;
		$row['ID_Location'] = $this->ID_Location->CurrentValue;
		$row['Pcs_RemainPicking'] = $this->Pcs_RemainPicking->CurrentValue;
		$row['PCS'] = $this->PCS->CurrentValue;
		$row['MFG'] = $this->MFG->CurrentValue;
		$row['DateIn'] = $this->DateIn->CurrentValue;
		$row['Imp_id'] = $this->Imp_id->CurrentValue;
		$row['User_ID'] = $this->User_ID->CurrentValue;
		$row['Note_PalletId'] = $this->Note_PalletId->CurrentValue;
		$row['CreateUser'] = $this->CreateUser->CurrentValue;
		$row['CreateDate'] = $this->CreateDate->CurrentValue;
		$row['UpdateUser'] = $this->UpdateUser->CurrentValue;
		$row['UpdateDate'] = $this->UpdateDate->CurrentValue;
		$row['StatusPicking'] = $this->StatusPicking->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ID_Stock")) <> "")
			$this->ID_Stock->CurrentValue = $this->getKey("ID_Stock"); // ID_Stock
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
		// ID_Stock

		$this->ID_Stock->CellCssStyle = "white-space: nowrap;";

		// PalletID
		$this->PalletID->CellCssStyle = "white-space: nowrap;";

		// Code
		$this->Code->CellCssStyle = "white-space: nowrap;";

		// IdType
		$this->IdType->CellCssStyle = "white-space: nowrap;";

		// ID_Location
		$this->ID_Location->CellCssStyle = "white-space: nowrap;";

		// Pcs_RemainPicking
		$this->Pcs_RemainPicking->CellCssStyle = "white-space: nowrap;";

		// PCS
		$this->PCS->CellCssStyle = "white-space: nowrap;";

		// MFG
		$this->MFG->CellCssStyle = "white-space: nowrap;";

		// DateIn
		$this->DateIn->CellCssStyle = "white-space: nowrap;";

		// Imp_id
		$this->Imp_id->CellCssStyle = "white-space: nowrap;";

		// User_ID
		$this->User_ID->CellCssStyle = "white-space: nowrap;";

		// Note_PalletId
		$this->Note_PalletId->CellCssStyle = "white-space: nowrap;";

		// CreateUser
		$this->CreateUser->CellCssStyle = "white-space: nowrap;";

		// CreateDate
		$this->CreateDate->CellCssStyle = "white-space: nowrap;";

		// UpdateUser
		$this->UpdateUser->CellCssStyle = "white-space: nowrap;";

		// UpdateDate
		$this->UpdateDate->CellCssStyle = "white-space: nowrap;";

		// StatusPicking
		$this->StatusPicking->CellCssStyle = "white-space: nowrap;";

		// Accumulate aggregate value
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT && $this->RowType <> ROWTYPE_AGGREGATE) {
			if (is_numeric($this->Pcs_RemainPicking->CurrentValue))
				$this->Pcs_RemainPicking->Total += $this->Pcs_RemainPicking->CurrentValue; // Accumulate total
		}
		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// PalletID
			$this->PalletID->ViewValue = $this->PalletID->CurrentValue;
			$this->PalletID->ViewCustomAttributes = "";

			// Code
			$this->Code->ViewValue = $this->Code->CurrentValue;
			$this->Code->CssClass = "font-weight-bold";
			$this->Code->ViewCustomAttributes = "";

			// IdType
			$curVal = strval($this->IdType->CurrentValue);
			if ($curVal <> "") {
				$this->IdType->ViewValue = $this->IdType->lookupCacheOption($curVal);
				if ($this->IdType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`IdType`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->IdType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->IdType->ViewValue = $this->IdType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->IdType->ViewValue = $this->IdType->CurrentValue;
					}
				}
			} else {
				$this->IdType->ViewValue = NULL;
			}
			$this->IdType->CellCssStyle .= "text-align: center;";
			$this->IdType->ViewCustomAttributes = "";

			// ID_Location
			if ($this->ID_Location->VirtualValue <> "") {
				$this->ID_Location->ViewValue = $this->ID_Location->VirtualValue;
			} else {
				$this->ID_Location->ViewValue = $this->ID_Location->CurrentValue;
			$curVal = strval($this->ID_Location->CurrentValue);
			if ($curVal <> "") {
				$this->ID_Location->ViewValue = $this->ID_Location->lookupCacheOption($curVal);
				if ($this->ID_Location->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ID_Location`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ID_Location->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->ID_Location->ViewValue = $this->ID_Location->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ID_Location->ViewValue = $this->ID_Location->CurrentValue;
					}
				}
			} else {
				$this->ID_Location->ViewValue = NULL;
			}
			}
			$this->ID_Location->ViewCustomAttributes = "";

			// Pcs_RemainPicking
			$this->Pcs_RemainPicking->ViewValue = $this->Pcs_RemainPicking->CurrentValue;
			$this->Pcs_RemainPicking->ViewValue = FormatNumber($this->Pcs_RemainPicking->ViewValue, 0, -2, -2, -2);
			$this->Pcs_RemainPicking->CssClass = "font-weight-bold";
			$this->Pcs_RemainPicking->CellCssStyle .= "text-align: right;";
			$this->Pcs_RemainPicking->ViewCustomAttributes = "";

			// MFG
			$this->MFG->ViewValue = $this->MFG->CurrentValue;
			$this->MFG->ViewValue = FormatDateTime($this->MFG->ViewValue, 7);
			$this->MFG->CssClass = "font-weight-bold";
			$this->MFG->CellCssStyle .= "text-align: center;";
			$this->MFG->ViewCustomAttributes = "";

			// Note_PalletId
			$this->Note_PalletId->ViewValue = $this->Note_PalletId->CurrentValue;
			$this->Note_PalletId->ViewCustomAttributes = "";

			// CreateUser
			$this->CreateUser->ViewValue = $this->CreateUser->CurrentValue;
			$this->CreateUser->ViewCustomAttributes = "";

			// CreateDate
			$this->CreateDate->ViewValue = $this->CreateDate->CurrentValue;
			$this->CreateDate->ViewValue = FormatDateTime($this->CreateDate->ViewValue, 11);
			$this->CreateDate->ViewCustomAttributes = "";

			// PalletID
			$this->PalletID->LinkCustomAttributes = "";
			$this->PalletID->HrefValue = "";
			$this->PalletID->TooltipValue = "";
			if (!$this->isExport())
				$this->PalletID->ViewValue = $this->highlightValue($this->PalletID);

			// Code
			$this->Code->LinkCustomAttributes = "";
			$this->Code->HrefValue = "";
			$this->Code->TooltipValue = "";
			if (!$this->isExport())
				$this->Code->ViewValue = $this->highlightValue($this->Code);

			// IdType
			$this->IdType->LinkCustomAttributes = "";
			$this->IdType->HrefValue = "";
			$this->IdType->TooltipValue = "";

			// ID_Location
			$this->ID_Location->LinkCustomAttributes = "";
			$this->ID_Location->HrefValue = "";
			$this->ID_Location->TooltipValue = "";

			// Pcs_RemainPicking
			$this->Pcs_RemainPicking->LinkCustomAttributes = "";
			$this->Pcs_RemainPicking->HrefValue = "";
			$this->Pcs_RemainPicking->TooltipValue = "";

			// MFG
			$this->MFG->LinkCustomAttributes = "";
			$this->MFG->HrefValue = "";
			$this->MFG->TooltipValue = "";

			// Note_PalletId
			$this->Note_PalletId->LinkCustomAttributes = "";
			$this->Note_PalletId->HrefValue = "";
			$this->Note_PalletId->TooltipValue = "";

			// CreateUser
			$this->CreateUser->LinkCustomAttributes = "";
			$this->CreateUser->HrefValue = "";
			$this->CreateUser->TooltipValue = "";

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";
			$this->CreateDate->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// PalletID
			$this->PalletID->EditAttrs["class"] = "form-control";
			$this->PalletID->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->PalletID->CurrentValue = HtmlDecode($this->PalletID->CurrentValue);
			$this->PalletID->EditValue = HtmlEncode($this->PalletID->CurrentValue);
			$this->PalletID->PlaceHolder = RemoveHtml($this->PalletID->caption());

			// Code
			$this->Code->EditAttrs["class"] = "form-control";
			$this->Code->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Code->CurrentValue = HtmlDecode($this->Code->CurrentValue);
			$this->Code->EditValue = HtmlEncode($this->Code->CurrentValue);
			$this->Code->PlaceHolder = RemoveHtml($this->Code->caption());

			// IdType
			$this->IdType->EditAttrs["class"] = "form-control";
			$this->IdType->EditCustomAttributes = "";
			$curVal = trim(strval($this->IdType->CurrentValue));
			if ($curVal <> "")
				$this->IdType->ViewValue = $this->IdType->lookupCacheOption($curVal);
			else
				$this->IdType->ViewValue = $this->IdType->Lookup !== NULL && is_array($this->IdType->Lookup->Options) ? $curVal : NULL;
			if ($this->IdType->ViewValue !== NULL) { // Load from cache
				$this->IdType->EditValue = array_values($this->IdType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`IdType`" . SearchString("=", $this->IdType->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->IdType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->IdType->EditValue = $arwrk;
			}

			// ID_Location
			$this->ID_Location->EditAttrs["class"] = "form-control";
			$this->ID_Location->EditCustomAttributes = "";
			$this->ID_Location->EditValue = HtmlEncode($this->ID_Location->CurrentValue);
			$curVal = strval($this->ID_Location->CurrentValue);
			if ($curVal <> "") {
				$this->ID_Location->EditValue = $this->ID_Location->lookupCacheOption($curVal);
				if ($this->ID_Location->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ID_Location`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ID_Location->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ID_Location->EditValue = $this->ID_Location->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ID_Location->EditValue = HtmlEncode($this->ID_Location->CurrentValue);
					}
				}
			} else {
				$this->ID_Location->EditValue = NULL;
			}
			$this->ID_Location->PlaceHolder = RemoveHtml($this->ID_Location->caption());

			// Pcs_RemainPicking
			$this->Pcs_RemainPicking->EditAttrs["class"] = "form-control";
			$this->Pcs_RemainPicking->EditCustomAttributes = "";
			$this->Pcs_RemainPicking->EditValue = HtmlEncode($this->Pcs_RemainPicking->CurrentValue);
			$this->Pcs_RemainPicking->PlaceHolder = RemoveHtml($this->Pcs_RemainPicking->caption());

			// MFG
			$this->MFG->EditAttrs["class"] = "form-control";
			$this->MFG->EditCustomAttributes = "";
			$this->MFG->EditValue = HtmlEncode(FormatDateTime($this->MFG->CurrentValue, 7));
			$this->MFG->PlaceHolder = RemoveHtml($this->MFG->caption());

			// Note_PalletId
			$this->Note_PalletId->EditAttrs["class"] = "form-control";
			$this->Note_PalletId->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Note_PalletId->CurrentValue = HtmlDecode($this->Note_PalletId->CurrentValue);
			$this->Note_PalletId->EditValue = HtmlEncode($this->Note_PalletId->CurrentValue);
			$this->Note_PalletId->PlaceHolder = RemoveHtml($this->Note_PalletId->caption());

			// CreateUser
			$this->CreateUser->EditAttrs["class"] = "form-control";
			$this->CreateUser->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->CreateUser->CurrentValue = HtmlDecode($this->CreateUser->CurrentValue);
			$this->CreateUser->EditValue = HtmlEncode($this->CreateUser->CurrentValue);
			$this->CreateUser->PlaceHolder = RemoveHtml($this->CreateUser->caption());

			// CreateDate
			$this->CreateDate->EditAttrs["class"] = "form-control";
			$this->CreateDate->EditCustomAttributes = "";
			$this->CreateDate->EditValue = HtmlEncode(FormatDateTime($this->CreateDate->CurrentValue, 11));
			$this->CreateDate->PlaceHolder = RemoveHtml($this->CreateDate->caption());

			// Add refer script
			// PalletID

			$this->PalletID->LinkCustomAttributes = "";
			$this->PalletID->HrefValue = "";

			// Code
			$this->Code->LinkCustomAttributes = "";
			$this->Code->HrefValue = "";

			// IdType
			$this->IdType->LinkCustomAttributes = "";
			$this->IdType->HrefValue = "";

			// ID_Location
			$this->ID_Location->LinkCustomAttributes = "";
			$this->ID_Location->HrefValue = "";

			// Pcs_RemainPicking
			$this->Pcs_RemainPicking->LinkCustomAttributes = "";
			$this->Pcs_RemainPicking->HrefValue = "";

			// MFG
			$this->MFG->LinkCustomAttributes = "";
			$this->MFG->HrefValue = "";

			// Note_PalletId
			$this->Note_PalletId->LinkCustomAttributes = "";
			$this->Note_PalletId->HrefValue = "";

			// CreateUser
			$this->CreateUser->LinkCustomAttributes = "";
			$this->CreateUser->HrefValue = "";

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// PalletID
			$this->PalletID->EditAttrs["class"] = "form-control";
			$this->PalletID->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->PalletID->CurrentValue = HtmlDecode($this->PalletID->CurrentValue);
			$this->PalletID->EditValue = HtmlEncode($this->PalletID->CurrentValue);
			$this->PalletID->PlaceHolder = RemoveHtml($this->PalletID->caption());

			// Code
			$this->Code->EditAttrs["class"] = "form-control";
			$this->Code->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Code->CurrentValue = HtmlDecode($this->Code->CurrentValue);
			$this->Code->EditValue = HtmlEncode($this->Code->CurrentValue);
			$this->Code->PlaceHolder = RemoveHtml($this->Code->caption());

			// IdType
			$this->IdType->EditAttrs["class"] = "form-control";
			$this->IdType->EditCustomAttributes = "";
			$curVal = trim(strval($this->IdType->CurrentValue));
			if ($curVal <> "")
				$this->IdType->ViewValue = $this->IdType->lookupCacheOption($curVal);
			else
				$this->IdType->ViewValue = $this->IdType->Lookup !== NULL && is_array($this->IdType->Lookup->Options) ? $curVal : NULL;
			if ($this->IdType->ViewValue !== NULL) { // Load from cache
				$this->IdType->EditValue = array_values($this->IdType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`IdType`" . SearchString("=", $this->IdType->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->IdType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->IdType->EditValue = $arwrk;
			}

			// ID_Location
			$this->ID_Location->EditAttrs["class"] = "form-control";
			$this->ID_Location->EditCustomAttributes = "";
			$this->ID_Location->EditValue = HtmlEncode($this->ID_Location->CurrentValue);
			$curVal = strval($this->ID_Location->CurrentValue);
			if ($curVal <> "") {
				$this->ID_Location->EditValue = $this->ID_Location->lookupCacheOption($curVal);
				if ($this->ID_Location->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ID_Location`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ID_Location->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ID_Location->EditValue = $this->ID_Location->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ID_Location->EditValue = HtmlEncode($this->ID_Location->CurrentValue);
					}
				}
			} else {
				$this->ID_Location->EditValue = NULL;
			}
			$this->ID_Location->PlaceHolder = RemoveHtml($this->ID_Location->caption());

			// Pcs_RemainPicking
			$this->Pcs_RemainPicking->EditAttrs["class"] = "form-control";
			$this->Pcs_RemainPicking->EditCustomAttributes = "";
			$this->Pcs_RemainPicking->EditValue = HtmlEncode($this->Pcs_RemainPicking->CurrentValue);
			$this->Pcs_RemainPicking->PlaceHolder = RemoveHtml($this->Pcs_RemainPicking->caption());

			// MFG
			$this->MFG->EditAttrs["class"] = "form-control";
			$this->MFG->EditCustomAttributes = "";
			$this->MFG->EditValue = $this->MFG->CurrentValue;
			$this->MFG->EditValue = FormatDateTime($this->MFG->EditValue, 7);
			$this->MFG->CssClass = "font-weight-bold";
			$this->MFG->CellCssStyle .= "text-align: center;";
			$this->MFG->ViewCustomAttributes = "";

			// Note_PalletId
			$this->Note_PalletId->EditAttrs["class"] = "form-control";
			$this->Note_PalletId->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Note_PalletId->CurrentValue = HtmlDecode($this->Note_PalletId->CurrentValue);
			$this->Note_PalletId->EditValue = HtmlEncode($this->Note_PalletId->CurrentValue);
			$this->Note_PalletId->PlaceHolder = RemoveHtml($this->Note_PalletId->caption());

			// CreateUser
			$this->CreateUser->EditAttrs["class"] = "form-control";
			$this->CreateUser->EditCustomAttributes = "";
			$this->CreateUser->EditValue = $this->CreateUser->CurrentValue;
			$this->CreateUser->ViewCustomAttributes = "";

			// CreateDate
			$this->CreateDate->EditAttrs["class"] = "form-control";
			$this->CreateDate->EditCustomAttributes = "";
			$this->CreateDate->EditValue = $this->CreateDate->CurrentValue;
			$this->CreateDate->EditValue = FormatDateTime($this->CreateDate->EditValue, 11);
			$this->CreateDate->ViewCustomAttributes = "";

			// Edit refer script
			// PalletID

			$this->PalletID->LinkCustomAttributes = "";
			$this->PalletID->HrefValue = "";

			// Code
			$this->Code->LinkCustomAttributes = "";
			$this->Code->HrefValue = "";

			// IdType
			$this->IdType->LinkCustomAttributes = "";
			$this->IdType->HrefValue = "";

			// ID_Location
			$this->ID_Location->LinkCustomAttributes = "";
			$this->ID_Location->HrefValue = "";

			// Pcs_RemainPicking
			$this->Pcs_RemainPicking->LinkCustomAttributes = "";
			$this->Pcs_RemainPicking->HrefValue = "";

			// MFG
			$this->MFG->LinkCustomAttributes = "";
			$this->MFG->HrefValue = "";
			$this->MFG->TooltipValue = "";

			// Note_PalletId
			$this->Note_PalletId->LinkCustomAttributes = "";
			$this->Note_PalletId->HrefValue = "";

			// CreateUser
			$this->CreateUser->LinkCustomAttributes = "";
			$this->CreateUser->HrefValue = "";
			$this->CreateUser->TooltipValue = "";

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";
			$this->CreateDate->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// PalletID
			$this->PalletID->EditAttrs["class"] = "form-control";
			$this->PalletID->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->PalletID->AdvancedSearch->SearchValue = HtmlDecode($this->PalletID->AdvancedSearch->SearchValue);
			$this->PalletID->EditValue = HtmlEncode($this->PalletID->AdvancedSearch->SearchValue);
			$this->PalletID->PlaceHolder = RemoveHtml($this->PalletID->caption());

			// Code
			$this->Code->EditAttrs["class"] = "form-control";
			$this->Code->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Code->AdvancedSearch->SearchValue = HtmlDecode($this->Code->AdvancedSearch->SearchValue);
			$this->Code->EditValue = HtmlEncode($this->Code->AdvancedSearch->SearchValue);
			$this->Code->PlaceHolder = RemoveHtml($this->Code->caption());

			// IdType
			$this->IdType->EditAttrs["class"] = "form-control";
			$this->IdType->EditCustomAttributes = "";
			$curVal = trim(strval($this->IdType->AdvancedSearch->SearchValue));
			if ($curVal <> "")
				$this->IdType->AdvancedSearch->ViewValue = $this->IdType->lookupCacheOption($curVal);
			else
				$this->IdType->AdvancedSearch->ViewValue = $this->IdType->Lookup !== NULL && is_array($this->IdType->Lookup->Options) ? $curVal : NULL;
			if ($this->IdType->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->IdType->EditValue = array_values($this->IdType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`IdType`" . SearchString("=", $this->IdType->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->IdType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->IdType->EditValue = $arwrk;
			}

			// ID_Location
			$this->ID_Location->EditAttrs["class"] = "form-control";
			$this->ID_Location->EditCustomAttributes = "";
			$this->ID_Location->EditValue = HtmlEncode($this->ID_Location->AdvancedSearch->SearchValue);
			$this->ID_Location->PlaceHolder = RemoveHtml($this->ID_Location->caption());

			// Pcs_RemainPicking
			$this->Pcs_RemainPicking->EditAttrs["class"] = "form-control";
			$this->Pcs_RemainPicking->EditCustomAttributes = "";
			$this->Pcs_RemainPicking->EditValue = HtmlEncode($this->Pcs_RemainPicking->AdvancedSearch->SearchValue);
			$this->Pcs_RemainPicking->PlaceHolder = RemoveHtml($this->Pcs_RemainPicking->caption());

			// MFG
			$this->MFG->EditAttrs["class"] = "form-control";
			$this->MFG->EditCustomAttributes = "";
			$this->MFG->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->MFG->AdvancedSearch->SearchValue, 7), 7));
			$this->MFG->PlaceHolder = RemoveHtml($this->MFG->caption());
			$this->MFG->EditAttrs["class"] = "form-control";
			$this->MFG->EditCustomAttributes = "";
			$this->MFG->EditValue2 = HtmlEncode(FormatDateTime(UnFormatDateTime($this->MFG->AdvancedSearch->SearchValue2, 7), 7));
			$this->MFG->PlaceHolder = RemoveHtml($this->MFG->caption());

			// Note_PalletId
			$this->Note_PalletId->EditAttrs["class"] = "form-control";
			$this->Note_PalletId->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Note_PalletId->AdvancedSearch->SearchValue = HtmlDecode($this->Note_PalletId->AdvancedSearch->SearchValue);
			$this->Note_PalletId->EditValue = HtmlEncode($this->Note_PalletId->AdvancedSearch->SearchValue);
			$this->Note_PalletId->PlaceHolder = RemoveHtml($this->Note_PalletId->caption());

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
		} elseif ($this->RowType == ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$this->Pcs_RemainPicking->Total = 0; // Initialize total
		} elseif ($this->RowType == ROWTYPE_AGGREGATE) { // Aggregate row
			$this->Pcs_RemainPicking->CurrentValue = $this->Pcs_RemainPicking->Total;
			$this->Pcs_RemainPicking->ViewValue = $this->Pcs_RemainPicking->CurrentValue;
			$this->Pcs_RemainPicking->ViewValue = FormatNumber($this->Pcs_RemainPicking->ViewValue, 0, -2, -2, -2);
			$this->Pcs_RemainPicking->CssClass = "font-weight-bold";
			$this->Pcs_RemainPicking->CellCssStyle .= "text-align: right;";
			$this->Pcs_RemainPicking->ViewCustomAttributes = "";
			$this->Pcs_RemainPicking->HrefValue = ""; // Clear href value
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
		if (!CheckEuroDate($this->MFG->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->MFG->errorMessage());
		}
		if (!CheckEuroDate($this->MFG->AdvancedSearch->SearchValue2)) {
			AddMessage($SearchError, $this->MFG->errorMessage());
		}
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

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->ID_Stock->Required) {
			if (!$this->ID_Stock->IsDetailKey && $this->ID_Stock->FormValue != NULL && $this->ID_Stock->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Stock->caption(), $this->ID_Stock->RequiredErrorMessage));
			}
		}
		if ($this->PalletID->Required) {
			if (!$this->PalletID->IsDetailKey && $this->PalletID->FormValue != NULL && $this->PalletID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PalletID->caption(), $this->PalletID->RequiredErrorMessage));
			}
		}
		if ($this->Code->Required) {
			if (!$this->Code->IsDetailKey && $this->Code->FormValue != NULL && $this->Code->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Code->caption(), $this->Code->RequiredErrorMessage));
			}
		}
		if ($this->IdType->Required) {
			if (!$this->IdType->IsDetailKey && $this->IdType->FormValue != NULL && $this->IdType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IdType->caption(), $this->IdType->RequiredErrorMessage));
			}
		}
		if ($this->ID_Location->Required) {
			if (!$this->ID_Location->IsDetailKey && $this->ID_Location->FormValue != NULL && $this->ID_Location->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Location->caption(), $this->ID_Location->RequiredErrorMessage));
			}
		}
		if ($this->Pcs_RemainPicking->Required) {
			if (!$this->Pcs_RemainPicking->IsDetailKey && $this->Pcs_RemainPicking->FormValue != NULL && $this->Pcs_RemainPicking->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Pcs_RemainPicking->caption(), $this->Pcs_RemainPicking->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Pcs_RemainPicking->FormValue)) {
			AddMessage($FormError, $this->Pcs_RemainPicking->errorMessage());
		}
		if ($this->PCS->Required) {
			if (!$this->PCS->IsDetailKey && $this->PCS->FormValue != NULL && $this->PCS->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PCS->caption(), $this->PCS->RequiredErrorMessage));
			}
		}
		if ($this->MFG->Required) {
			if (!$this->MFG->IsDetailKey && $this->MFG->FormValue != NULL && $this->MFG->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MFG->caption(), $this->MFG->RequiredErrorMessage));
			}
		}
		if ($this->DateIn->Required) {
			if (!$this->DateIn->IsDetailKey && $this->DateIn->FormValue != NULL && $this->DateIn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateIn->caption(), $this->DateIn->RequiredErrorMessage));
			}
		}
		if ($this->Imp_id->Required) {
			if (!$this->Imp_id->IsDetailKey && $this->Imp_id->FormValue != NULL && $this->Imp_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Imp_id->caption(), $this->Imp_id->RequiredErrorMessage));
			}
		}
		if ($this->User_ID->Required) {
			if (!$this->User_ID->IsDetailKey && $this->User_ID->FormValue != NULL && $this->User_ID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->User_ID->caption(), $this->User_ID->RequiredErrorMessage));
			}
		}
		if ($this->Note_PalletId->Required) {
			if (!$this->Note_PalletId->IsDetailKey && $this->Note_PalletId->FormValue != NULL && $this->Note_PalletId->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Note_PalletId->caption(), $this->Note_PalletId->RequiredErrorMessage));
			}
		}
		if ($this->CreateUser->Required) {
			if (!$this->CreateUser->IsDetailKey && $this->CreateUser->FormValue != NULL && $this->CreateUser->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CreateUser->caption(), $this->CreateUser->RequiredErrorMessage));
			}
		}
		if ($this->CreateDate->Required) {
			if (!$this->CreateDate->IsDetailKey && $this->CreateDate->FormValue != NULL && $this->CreateDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CreateDate->caption(), $this->CreateDate->RequiredErrorMessage));
			}
		}
		if ($this->UpdateUser->Required) {
			if (!$this->UpdateUser->IsDetailKey && $this->UpdateUser->FormValue != NULL && $this->UpdateUser->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UpdateUser->caption(), $this->UpdateUser->RequiredErrorMessage));
			}
		}
		if ($this->UpdateDate->Required) {
			if (!$this->UpdateDate->IsDetailKey && $this->UpdateDate->FormValue != NULL && $this->UpdateDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UpdateDate->caption(), $this->UpdateDate->RequiredErrorMessage));
			}
		}
		if ($this->StatusPicking->Required) {
			if (!$this->StatusPicking->IsDetailKey && $this->StatusPicking->FormValue != NULL && $this->StatusPicking->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->StatusPicking->caption(), $this->StatusPicking->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Delete records based on current filter
	protected function deleteRows()
	{
		global $Language, $Security;
		if (!$Security->canDelete()) {
			$this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];
		if ($this->AuditTrailOnDelete)
			$this->writeAuditTrailDummy($Language->phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey <> "")
					$thisKey .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
				$thisKey .= $row['ID_Stock'];
				if (DELETE_UPLOADED_FILES) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($deleteRows === FALSE)
					break;
				if ($key <> "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("DeleteCancelled"));
			}
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($filter);
		$conn = &$this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// PalletID
			$this->PalletID->setDbValueDef($rsnew, $this->PalletID->CurrentValue, NULL, $this->PalletID->ReadOnly);

			// Code
			$this->Code->setDbValueDef($rsnew, $this->Code->CurrentValue, NULL, $this->Code->ReadOnly);

			// IdType
			$this->IdType->setDbValueDef($rsnew, $this->IdType->CurrentValue, NULL, $this->IdType->ReadOnly);

			// ID_Location
			$this->ID_Location->setDbValueDef($rsnew, $this->ID_Location->CurrentValue, NULL, $this->ID_Location->ReadOnly);

			// Pcs_RemainPicking
			$this->Pcs_RemainPicking->setDbValueDef($rsnew, $this->Pcs_RemainPicking->CurrentValue, NULL, $this->Pcs_RemainPicking->ReadOnly);

			// Note_PalletId
			$this->Note_PalletId->setDbValueDef($rsnew, $this->Note_PalletId->CurrentValue, NULL, $this->Note_PalletId->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);
			if ($updateRow) {
				$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Load row hash
	protected function loadRowHash()
	{
		$filter = $this->getRecordFilter();

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$rsRow = $conn->Execute($sql);
		$this->HashValue = ($rsRow && !$rsRow->EOF) ? $this->getRowHash($rsRow) : ""; // Get hash value for record
		$rsRow->close();
	}

	// Get Row Hash
	public function getRowHash(&$rs)
	{
		if (!$rs)
			return "";
		$hash = "";
		$hash .= GetFieldHash($rs->fields('PalletID')); // PalletID
		$hash .= GetFieldHash($rs->fields('Code')); // Code
		$hash .= GetFieldHash($rs->fields('IdType')); // IdType
		$hash .= GetFieldHash($rs->fields('ID_Location')); // ID_Location
		$hash .= GetFieldHash($rs->fields('Pcs_RemainPicking')); // Pcs_RemainPicking
		$hash .= GetFieldHash($rs->fields('Note_PalletId')); // Note_PalletId
		return md5($hash);
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = &$this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// PalletID
		$this->PalletID->setDbValueDef($rsnew, $this->PalletID->CurrentValue, NULL, FALSE);

		// Code
		$this->Code->setDbValueDef($rsnew, $this->Code->CurrentValue, NULL, FALSE);

		// IdType
		$this->IdType->setDbValueDef($rsnew, $this->IdType->CurrentValue, NULL, FALSE);

		// ID_Location
		$this->ID_Location->setDbValueDef($rsnew, $this->ID_Location->CurrentValue, NULL, FALSE);

		// Pcs_RemainPicking
		$this->Pcs_RemainPicking->setDbValueDef($rsnew, $this->Pcs_RemainPicking->CurrentValue, NULL, FALSE);

		// MFG
		$this->MFG->setDbValueDef($rsnew, UnFormatDateTime($this->MFG->CurrentValue, 7), NULL, FALSE);

		// Note_PalletId
		$this->Note_PalletId->setDbValueDef($rsnew, $this->Note_PalletId->CurrentValue, NULL, FALSE);

		// CreateUser
		$this->CreateUser->setDbValueDef($rsnew, $this->CreateUser->CurrentValue, NULL, FALSE);

		// CreateDate
		$this->CreateDate->setDbValueDef($rsnew, UnFormatDateTime($this->CreateDate->CurrentValue, 11), NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->PalletID->AdvancedSearch->load();
		$this->Code->AdvancedSearch->load();
		$this->IdType->AdvancedSearch->load();
		$this->ID_Location->AdvancedSearch->load();
		$this->MFG->AdvancedSearch->load();
		$this->CreateDate->AdvancedSearch->load();
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
				return "<a href=\"javascript:void(0);\" class=\" ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"ew.export(document.ftbl_stocklist,'" . CurrentPageName() . "','excel',true,true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"javascript:void(0);\" class=\" ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"ew.export(document.ftbl_stocklist,'" . CurrentPageName() . "','excel',false,true);\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"javascript:void(0);\" class=\" ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"ew.export(document.ftbl_stocklist,'" . CurrentPageName() . "','word',true,true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"javascript:void(0);\" class=\" ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"ew.export(document.ftbl_stocklist,'" . CurrentPageName() . "','word',false,true);\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"javascript:void(0);\" class=\" ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"ew.export(document.ftbl_stocklist,'" . CurrentPageName() . "','pdf',true,true);\">" . $Language->phrase("ExportToPDF") . "</a>";
			else
				return "<a href=\"javascript:void(0);\" class=\" ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"ew.export(document.ftbl_stocklist,'" . CurrentPageName() . "','pdf',false,true);\">" . $Language->phrase("ExportToPDF") . "</a>";
		} elseif (SameText($type, "html")) {
			return "<a href=\"javascript:void(0);\" class=\" ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" onclick=\"ew.export(document.ftbl_stocklist,'" . CurrentPageName() . "','html',false,true);\">" . $Language->phrase("ExportToHtml") . "</a>";
		} elseif (SameText($type, "xml")) {
			return "<a href=\"javascript:void(0);\" class=\" ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" onclick=\"ew.export(document.ftbl_stocklist,'" . CurrentPageName() . "','xml',false,true);\">" . $Language->phrase("ExportToXml") . "</a>";
		} elseif (SameText($type, "csv")) {
			return "<a href=\"javascript:void(0);\" class=\" ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" onclick=\"ew.export(document.ftbl_stocklist,'" . CurrentPageName() . "','csv',false,true);\">" . $Language->phrase("ExportToCsv") . "</a>";
		} elseif (SameText($type, "print")) {
			return "<a href=\"javascript:void(0);\" class=\" ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" onclick=\"ew.export(document.ftbl_stocklist,'" . CurrentPageName() . "','print',false,true);\">" . $Language->phrase("PrinterFriendly") . "</a>";
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
		$item->Body = "<button id=\"emf_tbl_stock\" class=\"ew-export-link ew-email\" title=\"" . $Language->phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->phrase("ExportToEmailText") . "\" onclick=\"ew.emailDialogShow({lnk:'emf_tbl_stock',hdr:ew.language.phrase('ExportToEmailText'),f:document.ftbl_stocklist,sel:true" . $url . "});\">" . $Language->phrase("ExportToEmail") . "</button>";
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
						case "x_IdType":
							break;
						case "x_ID_Location":
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