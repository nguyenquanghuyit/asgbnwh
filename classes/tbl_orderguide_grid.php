<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Page class
 */
class tbl_orderguide_grid extends tbl_orderguide
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{004E2122-9CCA-46AA-835C-0778C5A080BC}";

	// Table name
	public $TableName = 'tbl_orderguide';

	// Page object name
	public $PageObjName = "tbl_orderguide_grid";

	// Grid form hidden field names
	public $FormName = "ftbl_orderguidegrid";
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
		$this->FormActionName .= "_" . $this->FormName;
		$this->FormKeyName .= "_" . $this->FormName;
		$this->FormOldKeyName .= "_" . $this->FormName;
		$this->FormBlankRowName .= "_" . $this->FormName;
		$this->FormKeyCountName .= "_" . $this->FormName;
		$GLOBALS["Grid"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (tbl_orderguide)
		if (!isset($GLOBALS["tbl_orderguide"]) || get_class($GLOBALS["tbl_orderguide"]) == PROJECT_NAMESPACE . "tbl_orderguide") {
			$GLOBALS["tbl_orderguide"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["tbl_orderguide"];

		}
		$this->AddUrl = "tbl_orderguideadd.php";
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (tbl_user)
		if (!isset($GLOBALS['tbl_user']))
			$GLOBALS['tbl_user'] = new tbl_user();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_orderguide');

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

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions();
		$this->OtherOptions["addedit"]->Tag = "div";
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages;

		// Export
		global $EXPORT, $tbl_orderguide;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_orderguide);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}

//		$GLOBALS["Table"] = &$GLOBALS["MasterTable"];
		unset($GLOBALS["Grid"]);
		if ($url === "")
			return;
		if (!IsApi())
			$this->Page_Redirecting($url);

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
			$key .= @$ar['ID_Guide'];
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
			$this->ID_Guide->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->CreateUser->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->CreateDate->Visible = FALSE;
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
	public $ShowOtherOptions = FALSE;
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

		// Get grid add count
		$gridaddcnt = Get(TABLE_GRID_ADD_ROW_COUNT, "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();
		$this->ID_Guide->Visible = FALSE;
		$this->ID_Order->Visible = FALSE;
		$this->Code->setVisibility();
		$this->ProductName->setVisibility();
		$this->PCS_In->setVisibility();
		$this->PCS->setVisibility();
		$this->Qty->setVisibility();
		$this->Box->setVisibility();
		$this->ID_Location->setVisibility();
		$this->PalletID->setVisibility();
		$this->MFG->setVisibility();
		$this->DateIn->setVisibility();
		$this->Note_PickUp->Visible = FALSE;
		$this->CreateUser->Visible = FALSE;
		$this->CreateDate->setVisibility();
		$this->UpdateUser->Visible = FALSE;
		$this->UpdateDate->Visible = FALSE;
		$this->Note_PalletID->Visible = FALSE;
		$this->PCS_Loaded->Visible = FALSE;
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

		// Set up master detail parameters
		$this->setupMasterParms();

		// Setup other options
		$this->setupOtherOptions();

		// Set up lookup cache
		$this->setupLookupOptions($this->ID_Location);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Set up records per page
			$this->setupDisplayRecs();

			// Handle reset command
			$this->resetCmd();

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

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->isGridAdd() || $this->isGridEdit()) {
					$item = &$this->ListOptions->getItem("griddelete");
					if ($item)
						$item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->setupSortOrder();
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

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $this->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Restore detail filter
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode <> "add" && $this->getMasterFilter() <> "" && $this->getCurrentMasterTable() == "tbl_order") {
			global $tbl_order;
			$rsmaster = $tbl_order->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("tbl_orderlist.php"); // Return to master page
			} else {
				$tbl_order->loadListRowValues($rsmaster);
				$tbl_order->RowType = ROWTYPE_MASTER; // Master row
				$tbl_order->renderListRow();
				$rsmaster->close();
			}
		}

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}
		if ($this->isGridAdd()) {
			if ($this->CurrentMode == "copy") {
				$selectLimit = $this->UseSelectLimit;
				if ($selectLimit) {
					$this->TotalRecs = $this->listRecordCount();
					$this->Recordset = $this->loadRecordset($this->StartRec - 1, $this->DisplayRecs);
				} else {
					if ($this->Recordset = $this->loadRecordset())
						$this->TotalRecs = $this->Recordset->RecordCount();
				}
				$this->StartRec = 1;
				$this->DisplayRecs = $this->TotalRecs;
			} else {
				$this->CurrentFilter = "0=1";
				$this->StartRec = 1;
				$this->DisplayRecs = $this->GridAddRowCount;
			}
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
			$this->DisplayRecs = $this->TotalRecs; // Display all records
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
		}

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

	// Switch to Grid Add mode
	protected function gridAddMode()
	{
		$this->CurrentAction = "gridadd";
		$_SESSION[SESSION_INLINE_MODE] = "gridadd";
		$this->hideFieldsForAddEdit();
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

			// Get new recordset
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateSuccess")); // Batch update success
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
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
			$this->ID_Guide->setFormValue($arKeyFlds[0]);
			if (!is_numeric($this->ID_Guide->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	public function gridInsert()
	{
		global $Language, $CurrentForm, $FormError;
		$rowindex = 1;
		$gridInsert = FALSE;
		$conn = &$this->getConnection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridAddCancelled")); // Set grid add cancelled message
			return FALSE;
		}

		// Init key filter
		$wrkfilter = "";
		$addcnt = 0;
		if ($this->AuditTrailOnAdd)
			$this->writeAuditTrailDummy($Language->phrase("BatchInsertBegin")); // Batch insert begin
		$key = "";

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction <> "" && $rowaction <> "insert")
				continue; // Skip
			if ($rowaction == "insert") {
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
				$this->loadOldRecord(); // Load old record
			}
			$this->loadFormValues(); // Get form values
			if (!$this->emptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->validateForm()) {
					$gridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($FormError);
				} else {
					$gridInsert = $this->addRow($this->OldRecordset); // Insert this row
				}
				if ($gridInsert) {
					if ($key <> "")
						$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
					$key .= $this->ID_Guide->CurrentValue;

					// Add filter for this record
					$filter = $this->getRecordFilter();
					if ($wrkfilter <> "")
						$wrkfilter .= " OR ";
					$wrkfilter .= $filter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->clearInlineMode(); // Clear grid add mode and return
			return TRUE;
		}
		if ($gridInsert) {

			// Get new recordset
			$this->CurrentFilter = $wrkfilter;
			$sql = $this->getCurrentSql();
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertSuccess")); // Batch insert success
			$this->clearInlineMode(); // Clear grid add mode
		} else {
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertRollback")); // Batch insert rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
		}
		return $gridInsert;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_Code") && $CurrentForm->hasValue("o_Code") && $this->Code->CurrentValue <> $this->Code->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ProductName") && $CurrentForm->hasValue("o_ProductName") && $this->ProductName->CurrentValue <> $this->ProductName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PCS_In") && $CurrentForm->hasValue("o_PCS_In") && $this->PCS_In->CurrentValue <> $this->PCS_In->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PCS") && $CurrentForm->hasValue("o_PCS") && $this->PCS->CurrentValue <> $this->PCS->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Qty") && $CurrentForm->hasValue("o_Qty") && $this->Qty->CurrentValue <> $this->Qty->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Box") && $CurrentForm->hasValue("o_Box") && $this->Box->CurrentValue <> $this->Box->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ID_Location") && $CurrentForm->hasValue("o_ID_Location") && $this->ID_Location->CurrentValue <> $this->ID_Location->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PalletID") && $CurrentForm->hasValue("o_PalletID") && $this->PalletID->CurrentValue <> $this->PalletID->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_MFG") && $CurrentForm->hasValue("o_MFG") && $this->MFG->CurrentValue <> $this->MFG->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DateIn") && $CurrentForm->hasValue("o_DateIn") && $this->DateIn->CurrentValue <> $this->DateIn->OldValue)
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

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
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

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->ID_Order->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->setSessionOrderByList($orderBy);
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
			if ($CurrentForm->hasValue($this->FormOldKeyName))
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
			if ($this->RowOldKey <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $oldKeyName . "\" id=\"" . $oldKeyName . "\" value=\"" . HtmlEncode($this->RowOldKey) . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $CurrentForm->getValue($this->FormKeyName);
				$this->setupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") {
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
		if ($this->CurrentMode == "view") { // View mode
		} // End View mode
		if ($this->CurrentMode == "edit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->ID_Guide->CurrentValue . "\">";
		}
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	public function setRecordKey(&$key, $rs)
	{
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs->fields('ID_Guide');
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$option = &$this->OtherOptions["addedit"];
		$option->UseDropDownButton = FALSE;
		$option->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$option->UseButtonGroup = TRUE;

		//$option->ButtonClass = ""; // Class for button group
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if (($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") && !$this->isConfirm()) { // Check add/copy/edit mode
			if ($this->AllowAddDeleteRow) {
				$option = &$options["addedit"];
				$option->UseDropDownButton = FALSE;
				$item = &$option->add("addblankrow");
				$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
				$item->Visible = FALSE;
				$this->ShowOtherOptions = $item->Visible;
			}
		}
		if ($this->CurrentMode == "view") { // Check view mode
			$option = &$options["addedit"];
			$item = &$option->getItem("add");
			$this->ShowOtherOptions = $item && $item->Visible;
		}
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

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->ID_Guide->CurrentValue = NULL;
		$this->ID_Guide->OldValue = $this->ID_Guide->CurrentValue;
		$this->ID_Order->CurrentValue = NULL;
		$this->ID_Order->OldValue = $this->ID_Order->CurrentValue;
		$this->Code->CurrentValue = NULL;
		$this->Code->OldValue = $this->Code->CurrentValue;
		$this->ProductName->CurrentValue = NULL;
		$this->ProductName->OldValue = $this->ProductName->CurrentValue;
		$this->PCS_In->CurrentValue = NULL;
		$this->PCS_In->OldValue = $this->PCS_In->CurrentValue;
		$this->PCS->CurrentValue = NULL;
		$this->PCS->OldValue = $this->PCS->CurrentValue;
		$this->Qty->CurrentValue = 1;
		$this->Qty->OldValue = $this->Qty->CurrentValue;
		$this->Box->CurrentValue = NULL;
		$this->Box->OldValue = $this->Box->CurrentValue;
		$this->ID_Location->CurrentValue = NULL;
		$this->ID_Location->OldValue = $this->ID_Location->CurrentValue;
		$this->PalletID->CurrentValue = NULL;
		$this->PalletID->OldValue = $this->PalletID->CurrentValue;
		$this->MFG->CurrentValue = NULL;
		$this->MFG->OldValue = $this->MFG->CurrentValue;
		$this->DateIn->CurrentValue = NULL;
		$this->DateIn->OldValue = $this->DateIn->CurrentValue;
		$this->Note_PickUp->CurrentValue = NULL;
		$this->Note_PickUp->OldValue = $this->Note_PickUp->CurrentValue;
		$this->CreateUser->CurrentValue = NULL;
		$this->CreateUser->OldValue = $this->CreateUser->CurrentValue;
		$this->CreateDate->CurrentValue = NULL;
		$this->CreateDate->OldValue = $this->CreateDate->CurrentValue;
		$this->UpdateUser->CurrentValue = NULL;
		$this->UpdateUser->OldValue = $this->UpdateUser->CurrentValue;
		$this->UpdateDate->CurrentValue = NULL;
		$this->UpdateDate->OldValue = $this->UpdateDate->CurrentValue;
		$this->Note_PalletID->CurrentValue = NULL;
		$this->Note_PalletID->OldValue = $this->Note_PalletID->CurrentValue;
		$this->PCS_Loaded->CurrentValue = 0;
		$this->PCS_Loaded->OldValue = $this->PCS_Loaded->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'Code' first before field var 'x_Code'
		$val = $CurrentForm->hasValue("Code") ? $CurrentForm->getValue("Code") : $CurrentForm->getValue("x_Code");
		if (!$this->Code->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Code->Visible = FALSE; // Disable update for API request
			else
				$this->Code->setFormValue($val);
		}
		$this->Code->setOldValue($CurrentForm->getValue("o_Code"));

		// Check field name 'ProductName' first before field var 'x_ProductName'
		$val = $CurrentForm->hasValue("ProductName") ? $CurrentForm->getValue("ProductName") : $CurrentForm->getValue("x_ProductName");
		if (!$this->ProductName->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ProductName->Visible = FALSE; // Disable update for API request
			else
				$this->ProductName->setFormValue($val);
		}
		$this->ProductName->setOldValue($CurrentForm->getValue("o_ProductName"));

		// Check field name 'PCS_In' first before field var 'x_PCS_In'
		$val = $CurrentForm->hasValue("PCS_In") ? $CurrentForm->getValue("PCS_In") : $CurrentForm->getValue("x_PCS_In");
		if (!$this->PCS_In->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PCS_In->Visible = FALSE; // Disable update for API request
			else
				$this->PCS_In->setFormValue($val);
		}
		$this->PCS_In->setOldValue($CurrentForm->getValue("o_PCS_In"));

		// Check field name 'PCS' first before field var 'x_PCS'
		$val = $CurrentForm->hasValue("PCS") ? $CurrentForm->getValue("PCS") : $CurrentForm->getValue("x_PCS");
		if (!$this->PCS->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PCS->Visible = FALSE; // Disable update for API request
			else
				$this->PCS->setFormValue($val);
		}
		$this->PCS->setOldValue($CurrentForm->getValue("o_PCS"));

		// Check field name 'Qty' first before field var 'x_Qty'
		$val = $CurrentForm->hasValue("Qty") ? $CurrentForm->getValue("Qty") : $CurrentForm->getValue("x_Qty");
		if (!$this->Qty->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Qty->Visible = FALSE; // Disable update for API request
			else
				$this->Qty->setFormValue($val);
		}
		$this->Qty->setOldValue($CurrentForm->getValue("o_Qty"));

		// Check field name 'Box' first before field var 'x_Box'
		$val = $CurrentForm->hasValue("Box") ? $CurrentForm->getValue("Box") : $CurrentForm->getValue("x_Box");
		if (!$this->Box->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Box->Visible = FALSE; // Disable update for API request
			else
				$this->Box->setFormValue($val);
		}
		$this->Box->setOldValue($CurrentForm->getValue("o_Box"));

		// Check field name 'ID_Location' first before field var 'x_ID_Location'
		$val = $CurrentForm->hasValue("ID_Location") ? $CurrentForm->getValue("ID_Location") : $CurrentForm->getValue("x_ID_Location");
		if (!$this->ID_Location->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Location->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Location->setFormValue($val);
		}
		$this->ID_Location->setOldValue($CurrentForm->getValue("o_ID_Location"));

		// Check field name 'PalletID' first before field var 'x_PalletID'
		$val = $CurrentForm->hasValue("PalletID") ? $CurrentForm->getValue("PalletID") : $CurrentForm->getValue("x_PalletID");
		if (!$this->PalletID->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PalletID->Visible = FALSE; // Disable update for API request
			else
				$this->PalletID->setFormValue($val);
		}
		$this->PalletID->setOldValue($CurrentForm->getValue("o_PalletID"));

		// Check field name 'MFG' first before field var 'x_MFG'
		$val = $CurrentForm->hasValue("MFG") ? $CurrentForm->getValue("MFG") : $CurrentForm->getValue("x_MFG");
		if (!$this->MFG->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->MFG->Visible = FALSE; // Disable update for API request
			else
				$this->MFG->setFormValue($val);
			$this->MFG->CurrentValue = UnFormatDateTime($this->MFG->CurrentValue, 7);
		}
		$this->MFG->setOldValue($CurrentForm->getValue("o_MFG"));

		// Check field name 'DateIn' first before field var 'x_DateIn'
		$val = $CurrentForm->hasValue("DateIn") ? $CurrentForm->getValue("DateIn") : $CurrentForm->getValue("x_DateIn");
		if (!$this->DateIn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DateIn->Visible = FALSE; // Disable update for API request
			else
				$this->DateIn->setFormValue($val);
			$this->DateIn->CurrentValue = UnFormatDateTime($this->DateIn->CurrentValue, 11);
		}
		$this->DateIn->setOldValue($CurrentForm->getValue("o_DateIn"));

		// Check field name 'CreateDate' first before field var 'x_CreateDate'
		$val = $CurrentForm->hasValue("CreateDate") ? $CurrentForm->getValue("CreateDate") : $CurrentForm->getValue("x_CreateDate");
		if (!$this->CreateDate->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CreateDate->Visible = FALSE; // Disable update for API request
			else
				$this->CreateDate->setFormValue($val);
			$this->CreateDate->CurrentValue = UnFormatDateTime($this->CreateDate->CurrentValue, 11);
		}
		$this->CreateDate->setOldValue($CurrentForm->getValue("o_CreateDate"));

		// Check field name 'ID_Guide' first before field var 'x_ID_Guide'
		$val = $CurrentForm->hasValue("ID_Guide") ? $CurrentForm->getValue("ID_Guide") : $CurrentForm->getValue("x_ID_Guide");
		if (!$this->ID_Guide->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->ID_Guide->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->ID_Guide->CurrentValue = $this->ID_Guide->FormValue;
		$this->Code->CurrentValue = $this->Code->FormValue;
		$this->ProductName->CurrentValue = $this->ProductName->FormValue;
		$this->PCS_In->CurrentValue = $this->PCS_In->FormValue;
		$this->PCS->CurrentValue = $this->PCS->FormValue;
		$this->Qty->CurrentValue = $this->Qty->FormValue;
		$this->Box->CurrentValue = $this->Box->FormValue;
		$this->ID_Location->CurrentValue = $this->ID_Location->FormValue;
		$this->PalletID->CurrentValue = $this->PalletID->FormValue;
		$this->MFG->CurrentValue = $this->MFG->FormValue;
		$this->MFG->CurrentValue = UnFormatDateTime($this->MFG->CurrentValue, 7);
		$this->DateIn->CurrentValue = $this->DateIn->FormValue;
		$this->DateIn->CurrentValue = UnFormatDateTime($this->DateIn->CurrentValue, 11);
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
		$this->ID_Guide->setDbValue($row['ID_Guide']);
		$this->ID_Order->setDbValue($row['ID_Order']);
		$this->Code->setDbValue($row['Code']);
		$this->ProductName->setDbValue($row['ProductName']);
		$this->PCS_In->setDbValue($row['PCS_In']);
		$this->PCS->setDbValue($row['PCS']);
		$this->Qty->setDbValue($row['Qty']);
		$this->Box->setDbValue($row['Box']);
		$this->ID_Location->setDbValue($row['ID_Location']);
		if (array_key_exists('EV__ID_Location', $rs->fields)) {
			$this->ID_Location->VirtualValue = $rs->fields('EV__ID_Location'); // Set up virtual field value
		} else {
			$this->ID_Location->VirtualValue = ""; // Clear value
		}
		$this->PalletID->setDbValue($row['PalletID']);
		$this->MFG->setDbValue($row['MFG']);
		$this->DateIn->setDbValue($row['DateIn']);
		$this->Note_PickUp->setDbValue($row['Note_PickUp']);
		$this->CreateUser->setDbValue($row['CreateUser']);
		$this->CreateDate->setDbValue($row['CreateDate']);
		$this->UpdateUser->setDbValue($row['UpdateUser']);
		$this->UpdateDate->setDbValue($row['UpdateDate']);
		$this->Note_PalletID->setDbValue($row['Note_PalletID']);
		$this->PCS_Loaded->setDbValue($row['PCS_Loaded']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ID_Guide'] = $this->ID_Guide->CurrentValue;
		$row['ID_Order'] = $this->ID_Order->CurrentValue;
		$row['Code'] = $this->Code->CurrentValue;
		$row['ProductName'] = $this->ProductName->CurrentValue;
		$row['PCS_In'] = $this->PCS_In->CurrentValue;
		$row['PCS'] = $this->PCS->CurrentValue;
		$row['Qty'] = $this->Qty->CurrentValue;
		$row['Box'] = $this->Box->CurrentValue;
		$row['ID_Location'] = $this->ID_Location->CurrentValue;
		$row['PalletID'] = $this->PalletID->CurrentValue;
		$row['MFG'] = $this->MFG->CurrentValue;
		$row['DateIn'] = $this->DateIn->CurrentValue;
		$row['Note_PickUp'] = $this->Note_PickUp->CurrentValue;
		$row['CreateUser'] = $this->CreateUser->CurrentValue;
		$row['CreateDate'] = $this->CreateDate->CurrentValue;
		$row['UpdateUser'] = $this->UpdateUser->CurrentValue;
		$row['UpdateDate'] = $this->UpdateDate->CurrentValue;
		$row['Note_PalletID'] = $this->Note_PalletID->CurrentValue;
		$row['PCS_Loaded'] = $this->PCS_Loaded->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$this->ID_Guide->CurrentValue = strval($arKeys[0]); // ID_Guide
			else
				$validKey = FALSE;
		} else {
			$validKey = FALSE;
		}

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
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ID_Guide

		$this->ID_Guide->CellCssStyle = "white-space: nowrap;";

		// ID_Order
		$this->ID_Order->CellCssStyle = "width: 10px; white-space: nowrap;";

		// Code
		$this->Code->CellCssStyle = "width: 50px; white-space: nowrap;";

		// ProductName
		$this->ProductName->CellCssStyle = "width: 150px; white-space: nowrap;";

		// PCS_In
		$this->PCS_In->CellCssStyle = "width: 5px; white-space: nowrap;";

		// PCS
		$this->PCS->CellCssStyle = "width: 5px; white-space: nowrap;";

		// Qty
		$this->Qty->CellCssStyle = "white-space: nowrap;";

		// Box
		$this->Box->CellCssStyle = "white-space: nowrap;";

		// ID_Location
		$this->ID_Location->CellCssStyle = "white-space: nowrap;";

		// PalletID
		$this->PalletID->CellCssStyle = "width: 50px; white-space: nowrap;";

		// MFG
		$this->MFG->CellCssStyle = "white-space: nowrap;";

		// DateIn
		$this->DateIn->CellCssStyle = "white-space: nowrap;";

		// Note_PickUp
		$this->Note_PickUp->CellCssStyle = "white-space: nowrap;";

		// CreateUser
		$this->CreateUser->CellCssStyle = "white-space: nowrap;";

		// CreateDate
		$this->CreateDate->CellCssStyle = "white-space: nowrap;";

		// UpdateUser
		$this->UpdateUser->CellCssStyle = "white-space: nowrap;";

		// UpdateDate
		$this->UpdateDate->CellCssStyle = "white-space: nowrap;";

		// Note_PalletID
		$this->Note_PalletID->CellCssStyle = "white-space: nowrap;";

		// PCS_Loaded
		$this->PCS_Loaded->CellCssStyle = "white-space: nowrap;";
		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// Code
			$this->Code->ViewValue = $this->Code->CurrentValue;
			$this->Code->ViewCustomAttributes = "";

			// ProductName
			$this->ProductName->ViewValue = $this->ProductName->CurrentValue;
			$this->ProductName->ViewCustomAttributes = "";

			// PCS_In
			$this->PCS_In->ViewValue = $this->PCS_In->CurrentValue;
			$this->PCS_In->ViewValue = FormatNumber($this->PCS_In->ViewValue, 0, -2, -2, -2);
			$this->PCS_In->CellCssStyle .= "text-align: right;";
			$this->PCS_In->ViewCustomAttributes = "";

			// PCS
			$this->PCS->ViewValue = $this->PCS->CurrentValue;
			$this->PCS->ViewValue = FormatNumber($this->PCS->ViewValue, 0, -2, -2, -2);
			$this->PCS->CssClass = "font-weight-bold";
			$this->PCS->CellCssStyle .= "text-align: right;";
			$this->PCS->ViewCustomAttributes = "";

			// Qty
			$this->Qty->ViewValue = $this->Qty->CurrentValue;
			$this->Qty->ViewValue = FormatNumber($this->Qty->ViewValue, 0, -2, -2, -2);
			$this->Qty->CellCssStyle .= "text-align: center;";
			$this->Qty->ViewCustomAttributes = "";

			// Box
			$this->Box->ViewValue = $this->Box->CurrentValue;
			$this->Box->ViewValue = FormatNumber($this->Box->ViewValue, 0, -2, -2, -2);
			$this->Box->CssClass = "font-weight-bold";
			$this->Box->CellCssStyle .= "text-align: center;";
			$this->Box->ViewCustomAttributes = "";

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

			// PalletID
			$this->PalletID->ViewValue = $this->PalletID->CurrentValue;
			$this->PalletID->ViewCustomAttributes = "";

			// MFG
			$this->MFG->ViewValue = $this->MFG->CurrentValue;
			$this->MFG->ViewValue = FormatDateTime($this->MFG->ViewValue, 7);
			$this->MFG->CssClass = "font-weight-bold";
			$this->MFG->CellCssStyle .= "text-align: center;";
			$this->MFG->ViewCustomAttributes = "";

			// DateIn
			$this->DateIn->ViewValue = $this->DateIn->CurrentValue;
			$this->DateIn->ViewValue = FormatDateTime($this->DateIn->ViewValue, 11);
			$this->DateIn->ViewCustomAttributes = "";

			// CreateDate
			$this->CreateDate->ViewValue = $this->CreateDate->CurrentValue;
			$this->CreateDate->ViewValue = FormatDateTime($this->CreateDate->ViewValue, 11);
			$this->CreateDate->ViewCustomAttributes = "";

			// UpdateUser
			$this->UpdateUser->ViewValue = $this->UpdateUser->CurrentValue;
			$this->UpdateUser->ViewCustomAttributes = "";

			// UpdateDate
			$this->UpdateDate->ViewValue = $this->UpdateDate->CurrentValue;
			$this->UpdateDate->ViewValue = FormatDateTime($this->UpdateDate->ViewValue, 0);
			$this->UpdateDate->ViewCustomAttributes = "";

			// Code
			$this->Code->LinkCustomAttributes = "";
			$this->Code->HrefValue = "";
			$this->Code->TooltipValue = "";

			// ProductName
			$this->ProductName->LinkCustomAttributes = "";
			$this->ProductName->HrefValue = "";
			$this->ProductName->TooltipValue = "";

			// PCS_In
			$this->PCS_In->LinkCustomAttributes = "";
			$this->PCS_In->HrefValue = "";
			$this->PCS_In->TooltipValue = "";

			// PCS
			$this->PCS->LinkCustomAttributes = "";
			$this->PCS->HrefValue = "";
			$this->PCS->TooltipValue = "";

			// Qty
			$this->Qty->LinkCustomAttributes = "";
			$this->Qty->HrefValue = "";
			$this->Qty->TooltipValue = "";

			// Box
			$this->Box->LinkCustomAttributes = "";
			$this->Box->HrefValue = "";
			$this->Box->TooltipValue = "";

			// ID_Location
			$this->ID_Location->LinkCustomAttributes = "";
			$this->ID_Location->HrefValue = "";
			$this->ID_Location->TooltipValue = "";

			// PalletID
			$this->PalletID->LinkCustomAttributes = "";
			$this->PalletID->HrefValue = "";
			$this->PalletID->TooltipValue = "";

			// MFG
			$this->MFG->LinkCustomAttributes = "";
			$this->MFG->HrefValue = "";
			$this->MFG->TooltipValue = "";

			// DateIn
			$this->DateIn->LinkCustomAttributes = "";
			$this->DateIn->HrefValue = "";
			$this->DateIn->TooltipValue = "";

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";
			$this->CreateDate->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// Code
			$this->Code->EditAttrs["class"] = "form-control";
			$this->Code->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Code->CurrentValue = HtmlDecode($this->Code->CurrentValue);
			$this->Code->EditValue = HtmlEncode($this->Code->CurrentValue);
			$this->Code->PlaceHolder = RemoveHtml($this->Code->caption());

			// ProductName
			$this->ProductName->EditAttrs["class"] = "form-control";
			$this->ProductName->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->ProductName->CurrentValue = HtmlDecode($this->ProductName->CurrentValue);
			$this->ProductName->EditValue = HtmlEncode($this->ProductName->CurrentValue);
			$this->ProductName->PlaceHolder = RemoveHtml($this->ProductName->caption());

			// PCS_In
			$this->PCS_In->EditAttrs["class"] = "form-control";
			$this->PCS_In->EditCustomAttributes = "";
			$this->PCS_In->EditValue = HtmlEncode($this->PCS_In->CurrentValue);
			$this->PCS_In->PlaceHolder = RemoveHtml($this->PCS_In->caption());

			// PCS
			$this->PCS->EditAttrs["class"] = "form-control";
			$this->PCS->EditCustomAttributes = "";
			$this->PCS->EditValue = HtmlEncode($this->PCS->CurrentValue);
			$this->PCS->PlaceHolder = RemoveHtml($this->PCS->caption());

			// Qty
			$this->Qty->EditAttrs["class"] = "form-control";
			$this->Qty->EditCustomAttributes = "";
			$this->Qty->EditValue = HtmlEncode($this->Qty->CurrentValue);
			$this->Qty->PlaceHolder = RemoveHtml($this->Qty->caption());

			// Box
			$this->Box->EditAttrs["class"] = "form-control";
			$this->Box->EditCustomAttributes = "";
			$this->Box->EditValue = HtmlEncode($this->Box->CurrentValue);
			$this->Box->PlaceHolder = RemoveHtml($this->Box->caption());

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

			// PalletID
			$this->PalletID->EditAttrs["class"] = "form-control";
			$this->PalletID->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->PalletID->CurrentValue = HtmlDecode($this->PalletID->CurrentValue);
			$this->PalletID->EditValue = HtmlEncode($this->PalletID->CurrentValue);
			$this->PalletID->PlaceHolder = RemoveHtml($this->PalletID->caption());

			// MFG
			$this->MFG->EditAttrs["class"] = "form-control";
			$this->MFG->EditCustomAttributes = "";
			$this->MFG->EditValue = HtmlEncode(FormatDateTime($this->MFG->CurrentValue, 7));
			$this->MFG->PlaceHolder = RemoveHtml($this->MFG->caption());

			// DateIn
			$this->DateIn->EditAttrs["class"] = "form-control";
			$this->DateIn->EditCustomAttributes = "";
			$this->DateIn->EditValue = HtmlEncode(FormatDateTime($this->DateIn->CurrentValue, 11));
			$this->DateIn->PlaceHolder = RemoveHtml($this->DateIn->caption());

			// CreateDate
			// Add refer script
			// Code

			$this->Code->LinkCustomAttributes = "";
			$this->Code->HrefValue = "";

			// ProductName
			$this->ProductName->LinkCustomAttributes = "";
			$this->ProductName->HrefValue = "";

			// PCS_In
			$this->PCS_In->LinkCustomAttributes = "";
			$this->PCS_In->HrefValue = "";

			// PCS
			$this->PCS->LinkCustomAttributes = "";
			$this->PCS->HrefValue = "";

			// Qty
			$this->Qty->LinkCustomAttributes = "";
			$this->Qty->HrefValue = "";

			// Box
			$this->Box->LinkCustomAttributes = "";
			$this->Box->HrefValue = "";

			// ID_Location
			$this->ID_Location->LinkCustomAttributes = "";
			$this->ID_Location->HrefValue = "";

			// PalletID
			$this->PalletID->LinkCustomAttributes = "";
			$this->PalletID->HrefValue = "";

			// MFG
			$this->MFG->LinkCustomAttributes = "";
			$this->MFG->HrefValue = "";

			// DateIn
			$this->DateIn->LinkCustomAttributes = "";
			$this->DateIn->HrefValue = "";

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// Code
			$this->Code->EditAttrs["class"] = "form-control";
			$this->Code->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Code->CurrentValue = HtmlDecode($this->Code->CurrentValue);
			$this->Code->EditValue = HtmlEncode($this->Code->CurrentValue);
			$this->Code->PlaceHolder = RemoveHtml($this->Code->caption());

			// ProductName
			$this->ProductName->EditAttrs["class"] = "form-control";
			$this->ProductName->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->ProductName->CurrentValue = HtmlDecode($this->ProductName->CurrentValue);
			$this->ProductName->EditValue = HtmlEncode($this->ProductName->CurrentValue);
			$this->ProductName->PlaceHolder = RemoveHtml($this->ProductName->caption());

			// PCS_In
			$this->PCS_In->EditAttrs["class"] = "form-control";
			$this->PCS_In->EditCustomAttributes = "";
			$this->PCS_In->EditValue = HtmlEncode($this->PCS_In->CurrentValue);
			$this->PCS_In->PlaceHolder = RemoveHtml($this->PCS_In->caption());

			// PCS
			$this->PCS->EditAttrs["class"] = "form-control";
			$this->PCS->EditCustomAttributes = "";
			$this->PCS->EditValue = HtmlEncode($this->PCS->CurrentValue);
			$this->PCS->PlaceHolder = RemoveHtml($this->PCS->caption());

			// Qty
			$this->Qty->EditAttrs["class"] = "form-control";
			$this->Qty->EditCustomAttributes = "";
			$this->Qty->EditValue = HtmlEncode($this->Qty->CurrentValue);
			$this->Qty->PlaceHolder = RemoveHtml($this->Qty->caption());

			// Box
			$this->Box->EditAttrs["class"] = "form-control";
			$this->Box->EditCustomAttributes = "";
			$this->Box->EditValue = HtmlEncode($this->Box->CurrentValue);
			$this->Box->PlaceHolder = RemoveHtml($this->Box->caption());

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

			// PalletID
			$this->PalletID->EditAttrs["class"] = "form-control";
			$this->PalletID->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->PalletID->CurrentValue = HtmlDecode($this->PalletID->CurrentValue);
			$this->PalletID->EditValue = HtmlEncode($this->PalletID->CurrentValue);
			$this->PalletID->PlaceHolder = RemoveHtml($this->PalletID->caption());

			// MFG
			$this->MFG->EditAttrs["class"] = "form-control";
			$this->MFG->EditCustomAttributes = "";
			$this->MFG->EditValue = HtmlEncode(FormatDateTime($this->MFG->CurrentValue, 7));
			$this->MFG->PlaceHolder = RemoveHtml($this->MFG->caption());

			// DateIn
			$this->DateIn->EditAttrs["class"] = "form-control";
			$this->DateIn->EditCustomAttributes = "";
			$this->DateIn->EditValue = HtmlEncode(FormatDateTime($this->DateIn->CurrentValue, 11));
			$this->DateIn->PlaceHolder = RemoveHtml($this->DateIn->caption());

			// CreateDate
			// Edit refer script
			// Code

			$this->Code->LinkCustomAttributes = "";
			$this->Code->HrefValue = "";

			// ProductName
			$this->ProductName->LinkCustomAttributes = "";
			$this->ProductName->HrefValue = "";

			// PCS_In
			$this->PCS_In->LinkCustomAttributes = "";
			$this->PCS_In->HrefValue = "";

			// PCS
			$this->PCS->LinkCustomAttributes = "";
			$this->PCS->HrefValue = "";

			// Qty
			$this->Qty->LinkCustomAttributes = "";
			$this->Qty->HrefValue = "";

			// Box
			$this->Box->LinkCustomAttributes = "";
			$this->Box->HrefValue = "";

			// ID_Location
			$this->ID_Location->LinkCustomAttributes = "";
			$this->ID_Location->HrefValue = "";

			// PalletID
			$this->PalletID->LinkCustomAttributes = "";
			$this->PalletID->HrefValue = "";

			// MFG
			$this->MFG->LinkCustomAttributes = "";
			$this->MFG->HrefValue = "";

			// DateIn
			$this->DateIn->LinkCustomAttributes = "";
			$this->DateIn->HrefValue = "";

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->ID_Guide->Required) {
			if (!$this->ID_Guide->IsDetailKey && $this->ID_Guide->FormValue != NULL && $this->ID_Guide->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Guide->caption(), $this->ID_Guide->RequiredErrorMessage));
			}
		}
		if ($this->ID_Order->Required) {
			if (!$this->ID_Order->IsDetailKey && $this->ID_Order->FormValue != NULL && $this->ID_Order->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Order->caption(), $this->ID_Order->RequiredErrorMessage));
			}
		}
		if ($this->Code->Required) {
			if (!$this->Code->IsDetailKey && $this->Code->FormValue != NULL && $this->Code->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Code->caption(), $this->Code->RequiredErrorMessage));
			}
		}
		if ($this->ProductName->Required) {
			if (!$this->ProductName->IsDetailKey && $this->ProductName->FormValue != NULL && $this->ProductName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProductName->caption(), $this->ProductName->RequiredErrorMessage));
			}
		}
		if ($this->PCS_In->Required) {
			if (!$this->PCS_In->IsDetailKey && $this->PCS_In->FormValue != NULL && $this->PCS_In->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PCS_In->caption(), $this->PCS_In->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PCS_In->FormValue)) {
			AddMessage($FormError, $this->PCS_In->errorMessage());
		}
		if ($this->PCS->Required) {
			if (!$this->PCS->IsDetailKey && $this->PCS->FormValue != NULL && $this->PCS->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PCS->caption(), $this->PCS->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PCS->FormValue)) {
			AddMessage($FormError, $this->PCS->errorMessage());
		}
		if ($this->Qty->Required) {
			if (!$this->Qty->IsDetailKey && $this->Qty->FormValue != NULL && $this->Qty->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Qty->caption(), $this->Qty->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Qty->FormValue)) {
			AddMessage($FormError, $this->Qty->errorMessage());
		}
		if ($this->Box->Required) {
			if (!$this->Box->IsDetailKey && $this->Box->FormValue != NULL && $this->Box->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Box->caption(), $this->Box->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Box->FormValue)) {
			AddMessage($FormError, $this->Box->errorMessage());
		}
		if ($this->ID_Location->Required) {
			if (!$this->ID_Location->IsDetailKey && $this->ID_Location->FormValue != NULL && $this->ID_Location->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Location->caption(), $this->ID_Location->RequiredErrorMessage));
			}
		}
		if ($this->PalletID->Required) {
			if (!$this->PalletID->IsDetailKey && $this->PalletID->FormValue != NULL && $this->PalletID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PalletID->caption(), $this->PalletID->RequiredErrorMessage));
			}
		}
		if ($this->MFG->Required) {
			if (!$this->MFG->IsDetailKey && $this->MFG->FormValue != NULL && $this->MFG->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MFG->caption(), $this->MFG->RequiredErrorMessage));
			}
		}
		if (!CheckEuroDate($this->MFG->FormValue)) {
			AddMessage($FormError, $this->MFG->errorMessage());
		}
		if ($this->DateIn->Required) {
			if (!$this->DateIn->IsDetailKey && $this->DateIn->FormValue != NULL && $this->DateIn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateIn->caption(), $this->DateIn->RequiredErrorMessage));
			}
		}
		if (!CheckEuroDate($this->DateIn->FormValue)) {
			AddMessage($FormError, $this->DateIn->errorMessage());
		}
		if ($this->Note_PickUp->Required) {
			if (!$this->Note_PickUp->IsDetailKey && $this->Note_PickUp->FormValue != NULL && $this->Note_PickUp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Note_PickUp->caption(), $this->Note_PickUp->RequiredErrorMessage));
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
		if ($this->Note_PalletID->Required) {
			if (!$this->Note_PalletID->IsDetailKey && $this->Note_PalletID->FormValue != NULL && $this->Note_PalletID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Note_PalletID->caption(), $this->Note_PalletID->RequiredErrorMessage));
			}
		}
		if ($this->PCS_Loaded->Required) {
			if (!$this->PCS_Loaded->IsDetailKey && $this->PCS_Loaded->FormValue != NULL && $this->PCS_Loaded->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PCS_Loaded->caption(), $this->PCS_Loaded->RequiredErrorMessage));
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
				$thisKey .= $row['ID_Guide'];
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

			// Code
			$this->Code->setDbValueDef($rsnew, $this->Code->CurrentValue, NULL, $this->Code->ReadOnly);

			// ProductName
			$this->ProductName->setDbValueDef($rsnew, $this->ProductName->CurrentValue, NULL, $this->ProductName->ReadOnly);

			// PCS_In
			$this->PCS_In->setDbValueDef($rsnew, $this->PCS_In->CurrentValue, NULL, $this->PCS_In->ReadOnly);

			// PCS
			$this->PCS->setDbValueDef($rsnew, $this->PCS->CurrentValue, NULL, $this->PCS->ReadOnly);

			// Qty
			$this->Qty->setDbValueDef($rsnew, $this->Qty->CurrentValue, NULL, $this->Qty->ReadOnly);

			// Box
			$this->Box->setDbValueDef($rsnew, $this->Box->CurrentValue, NULL, $this->Box->ReadOnly);

			// ID_Location
			$this->ID_Location->setDbValueDef($rsnew, $this->ID_Location->CurrentValue, NULL, $this->ID_Location->ReadOnly);

			// PalletID
			$this->PalletID->setDbValueDef($rsnew, $this->PalletID->CurrentValue, NULL, $this->PalletID->ReadOnly);

			// MFG
			$this->MFG->setDbValueDef($rsnew, UnFormatDateTime($this->MFG->CurrentValue, 7), NULL, $this->MFG->ReadOnly);

			// DateIn
			$this->DateIn->setDbValueDef($rsnew, UnFormatDateTime($this->DateIn->CurrentValue, 11), NULL, $this->DateIn->ReadOnly);

			// CreateDate
			$this->CreateDate->setDbValueDef($rsnew, CurrentDateTime(), NULL);
			$rsnew['CreateDate'] = &$this->CreateDate->DbValue;

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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Set up foreign key field value from Session
			if ($this->getCurrentMasterTable() == "tbl_order") {
				$this->ID_Order->CurrentValue = $this->ID_Order->getSessionValue();
			}
		$conn = &$this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// Code
		$this->Code->setDbValueDef($rsnew, $this->Code->CurrentValue, NULL, FALSE);

		// ProductName
		$this->ProductName->setDbValueDef($rsnew, $this->ProductName->CurrentValue, NULL, FALSE);

		// PCS_In
		$this->PCS_In->setDbValueDef($rsnew, $this->PCS_In->CurrentValue, NULL, FALSE);

		// PCS
		$this->PCS->setDbValueDef($rsnew, $this->PCS->CurrentValue, NULL, FALSE);

		// Qty
		$this->Qty->setDbValueDef($rsnew, $this->Qty->CurrentValue, NULL, strval($this->Qty->CurrentValue) == "");

		// Box
		$this->Box->setDbValueDef($rsnew, $this->Box->CurrentValue, NULL, FALSE);

		// ID_Location
		$this->ID_Location->setDbValueDef($rsnew, $this->ID_Location->CurrentValue, NULL, FALSE);

		// PalletID
		$this->PalletID->setDbValueDef($rsnew, $this->PalletID->CurrentValue, NULL, FALSE);

		// MFG
		$this->MFG->setDbValueDef($rsnew, UnFormatDateTime($this->MFG->CurrentValue, 7), NULL, FALSE);

		// DateIn
		$this->DateIn->setDbValueDef($rsnew, UnFormatDateTime($this->DateIn->CurrentValue, 11), NULL, FALSE);

		// CreateDate
		$this->CreateDate->setDbValueDef($rsnew, CurrentDateTime(), NULL);
		$rsnew['CreateDate'] = &$this->CreateDate->DbValue;

		// ID_Order
		if ($this->ID_Order->getSessionValue() <> "") {
			$rsnew['ID_Order'] = $this->ID_Order->getSessionValue();
		}

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

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{

		// Hide foreign keys
		$masterTblVar = $this->getCurrentMasterTable();
		if ($masterTblVar == "tbl_order") {
			$this->ID_Order->Visible = FALSE;
			if ($GLOBALS["tbl_order"]->EventCancelled)
				$this->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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
}
?>