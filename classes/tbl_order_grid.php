<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Page class
 */
class tbl_order_grid extends tbl_order
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{004E2122-9CCA-46AA-835C-0778C5A080BC}";

	// Table name
	public $TableName = 'tbl_order';

	// Page object name
	public $PageObjName = "tbl_order_grid";

	// Grid form hidden field names
	public $FormName = "ftbl_ordergrid";
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

		// Table object (tbl_order)
		if (!isset($GLOBALS["tbl_order"]) || get_class($GLOBALS["tbl_order"]) == PROJECT_NAMESPACE . "tbl_order") {
			$GLOBALS["tbl_order"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["tbl_order"];

		}
		$this->AddUrl = "tbl_orderadd.php";
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (tbl_user)
		if (!isset($GLOBALS['tbl_user']))
			$GLOBALS['tbl_user'] = new tbl_user();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_order');

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
		global $EXPORT, $tbl_order;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_order);
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
			$key .= @$ar['ID_Order'];
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
			$this->ID_Order->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->UpdateDate->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->UpdateUser->Visible = FALSE;
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
	public $tbl_orderguide_Count;
	public $tbl_orderdetail_Count;
	public $vwPackingdetail_Count;
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
		$this->ID_Order->setVisibility();
		$this->OrderDate->setVisibility();
		$this->InvoiceNo->setVisibility();
		$this->CusomterOrderNo->setVisibility();
		$this->IdType->setVisibility();
		$this->ID_Contact->setVisibility();
		$this->CreateUser->setVisibility();
		$this->CreateDate->setVisibility();
		$this->StatusLoad->setVisibility();
		$this->StatusFinishOrder->setVisibility();
		$this->DateTimefinishOrder->Visible = FALSE;
		$this->UserFinishOrder->Visible = FALSE;
		$this->UpdateDate->Visible = FALSE;
		$this->UpdateUser->Visible = FALSE;
		$this->PrintSubLable->Visible = FALSE;
		$this->Packing->Visible = FALSE;
		$this->FinishPacking->Visible = FALSE;
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
		$this->setupLookupOptions($this->IdType);
		$this->setupLookupOptions($this->ID_Contact);

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
		if ($this->CurrentMode <> "add" && $this->getMasterFilter() <> "" && $this->getCurrentMasterTable() == "tbl_history_pick") {
			global $tbl_history_pick;
			$rsmaster = $tbl_history_pick->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("tbl_history_picklist.php"); // Return to master page
			} else {
				$tbl_history_pick->loadListRowValues($rsmaster);
				$tbl_history_pick->RowType = ROWTYPE_MASTER; // Master row
				$tbl_history_pick->renderListRow();
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
			$this->ID_Order->setFormValue($arKeyFlds[0]);
			if (!is_numeric($this->ID_Order->FormValue))
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
					$key .= $this->ID_Order->CurrentValue;

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
		if ($CurrentForm->hasValue("x_OrderDate") && $CurrentForm->hasValue("o_OrderDate") && $this->OrderDate->CurrentValue <> $this->OrderDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_InvoiceNo") && $CurrentForm->hasValue("o_InvoiceNo") && $this->InvoiceNo->CurrentValue <> $this->InvoiceNo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_CusomterOrderNo") && $CurrentForm->hasValue("o_CusomterOrderNo") && $this->CusomterOrderNo->CurrentValue <> $this->CusomterOrderNo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_IdType") && $CurrentForm->hasValue("o_IdType") && $this->IdType->CurrentValue <> $this->IdType->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ID_Contact") && $CurrentForm->hasValue("o_ID_Contact") && $this->ID_Contact->CurrentValue <> $this->ID_Contact->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_CreateUser") && $CurrentForm->hasValue("o_CreateUser") && $this->CreateUser->CurrentValue <> $this->CreateUser->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_CreateDate") && $CurrentForm->hasValue("o_CreateDate") && $this->CreateDate->CurrentValue <> $this->CreateDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_StatusLoad") && $CurrentForm->hasValue("o_StatusLoad") && $this->StatusLoad->CurrentValue <> $this->StatusLoad->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_StatusFinishOrder") && $CurrentForm->hasValue("o_StatusFinishOrder") && $this->StatusFinishOrder->CurrentValue <> $this->StatusFinishOrder->OldValue)
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
				$this->ID_Order->setSort("DESC");
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

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canView();
		$item->OnLeft = TRUE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = TRUE;

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

		// "view"
		$opt = &$this->ListOptions->Items["view"];
		$viewcaption = HtmlTitle($Language->phrase("ViewLink"));
		if ($Security->canView()) {
			$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "edit"
		$opt = &$this->ListOptions->Items["edit"];
		$editcaption = HtmlTitle($Language->phrase("EditLink"));
		if ($Security->canEdit()) {
			$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("EditLink") . "</a>";
		} else {
			$opt->Body = "";
		}
		} // End View mode
		if ($this->CurrentMode == "edit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->ID_Order->CurrentValue . "\">";
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
		$key .= $rs->fields('ID_Order');
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

		// Add
		if ($this->CurrentMode == "view") { // Check view mode
			$item = &$option->add("add");
			$addcaption = HtmlTitle($Language->phrase("AddLink"));
			$this->AddUrl = $this->getAddUrl();
			$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
			$item->Visible = ($this->AddUrl <> "" && $Security->canAdd());
		}
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
				$item->Visible = $Security->canAdd();
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
		$this->ID_Order->CurrentValue = NULL;
		$this->ID_Order->OldValue = $this->ID_Order->CurrentValue;
		$this->OrderDate->CurrentValue = CurrentDateTime();
		$this->OrderDate->OldValue = $this->OrderDate->CurrentValue;
		$this->InvoiceNo->CurrentValue = NULL;
		$this->InvoiceNo->OldValue = $this->InvoiceNo->CurrentValue;
		$this->CusomterOrderNo->CurrentValue = NULL;
		$this->CusomterOrderNo->OldValue = $this->CusomterOrderNo->CurrentValue;
		$this->IdType->CurrentValue = NULL;
		$this->IdType->OldValue = $this->IdType->CurrentValue;
		$this->ID_Contact->CurrentValue = NULL;
		$this->ID_Contact->OldValue = $this->ID_Contact->CurrentValue;
		$this->CreateUser->CurrentValue = CurrentUserName();
		$this->CreateUser->OldValue = $this->CreateUser->CurrentValue;
		$this->CreateDate->CurrentValue = CurrentDateTime();
		$this->CreateDate->OldValue = $this->CreateDate->CurrentValue;
		$this->StatusLoad->CurrentValue = 0;
		$this->StatusLoad->OldValue = $this->StatusLoad->CurrentValue;
		$this->StatusFinishOrder->CurrentValue = b'0';
		$this->StatusFinishOrder->OldValue = $this->StatusFinishOrder->CurrentValue;
		$this->DateTimefinishOrder->CurrentValue = NULL;
		$this->DateTimefinishOrder->OldValue = $this->DateTimefinishOrder->CurrentValue;
		$this->UserFinishOrder->CurrentValue = NULL;
		$this->UserFinishOrder->OldValue = $this->UserFinishOrder->CurrentValue;
		$this->UpdateDate->CurrentValue = NULL;
		$this->UpdateDate->OldValue = $this->UpdateDate->CurrentValue;
		$this->UpdateUser->CurrentValue = NULL;
		$this->UpdateUser->OldValue = $this->UpdateUser->CurrentValue;
		$this->PrintSubLable->CurrentValue = b'0';
		$this->PrintSubLable->OldValue = $this->PrintSubLable->CurrentValue;
		$this->Packing->CurrentValue = b'0';
		$this->Packing->OldValue = $this->Packing->CurrentValue;
		$this->FinishPacking->CurrentValue = b'0';
		$this->FinishPacking->OldValue = $this->FinishPacking->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'ID_Order' first before field var 'x_ID_Order'
		$val = $CurrentForm->hasValue("ID_Order") ? $CurrentForm->getValue("ID_Order") : $CurrentForm->getValue("x_ID_Order");
		if (!$this->ID_Order->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->ID_Order->setFormValue($val);

		// Check field name 'OrderDate' first before field var 'x_OrderDate'
		$val = $CurrentForm->hasValue("OrderDate") ? $CurrentForm->getValue("OrderDate") : $CurrentForm->getValue("x_OrderDate");
		if (!$this->OrderDate->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->OrderDate->Visible = FALSE; // Disable update for API request
			else
				$this->OrderDate->setFormValue($val);
			$this->OrderDate->CurrentValue = UnFormatDateTime($this->OrderDate->CurrentValue, 7);
		}
		$this->OrderDate->setOldValue($CurrentForm->getValue("o_OrderDate"));

		// Check field name 'InvoiceNo' first before field var 'x_InvoiceNo'
		$val = $CurrentForm->hasValue("InvoiceNo") ? $CurrentForm->getValue("InvoiceNo") : $CurrentForm->getValue("x_InvoiceNo");
		if (!$this->InvoiceNo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->InvoiceNo->Visible = FALSE; // Disable update for API request
			else
				$this->InvoiceNo->setFormValue($val);
		}
		$this->InvoiceNo->setOldValue($CurrentForm->getValue("o_InvoiceNo"));

		// Check field name 'CusomterOrderNo' first before field var 'x_CusomterOrderNo'
		$val = $CurrentForm->hasValue("CusomterOrderNo") ? $CurrentForm->getValue("CusomterOrderNo") : $CurrentForm->getValue("x_CusomterOrderNo");
		if (!$this->CusomterOrderNo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CusomterOrderNo->Visible = FALSE; // Disable update for API request
			else
				$this->CusomterOrderNo->setFormValue($val);
		}
		$this->CusomterOrderNo->setOldValue($CurrentForm->getValue("o_CusomterOrderNo"));

		// Check field name 'IdType' first before field var 'x_IdType'
		$val = $CurrentForm->hasValue("IdType") ? $CurrentForm->getValue("IdType") : $CurrentForm->getValue("x_IdType");
		if (!$this->IdType->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->IdType->Visible = FALSE; // Disable update for API request
			else
				$this->IdType->setFormValue($val);
		}
		$this->IdType->setOldValue($CurrentForm->getValue("o_IdType"));

		// Check field name 'ID_Contact' first before field var 'x_ID_Contact'
		$val = $CurrentForm->hasValue("ID_Contact") ? $CurrentForm->getValue("ID_Contact") : $CurrentForm->getValue("x_ID_Contact");
		if (!$this->ID_Contact->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Contact->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Contact->setFormValue($val);
		}
		$this->ID_Contact->setOldValue($CurrentForm->getValue("o_ID_Contact"));

		// Check field name 'CreateUser' first before field var 'x_CreateUser'
		$val = $CurrentForm->hasValue("CreateUser") ? $CurrentForm->getValue("CreateUser") : $CurrentForm->getValue("x_CreateUser");
		if (!$this->CreateUser->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CreateUser->Visible = FALSE; // Disable update for API request
			else
				$this->CreateUser->setFormValue($val);
		}
		$this->CreateUser->setOldValue($CurrentForm->getValue("o_CreateUser"));

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

		// Check field name 'StatusLoad' first before field var 'x_StatusLoad'
		$val = $CurrentForm->hasValue("StatusLoad") ? $CurrentForm->getValue("StatusLoad") : $CurrentForm->getValue("x_StatusLoad");
		if (!$this->StatusLoad->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->StatusLoad->Visible = FALSE; // Disable update for API request
			else
				$this->StatusLoad->setFormValue($val);
		}
		$this->StatusLoad->setOldValue($CurrentForm->getValue("o_StatusLoad"));

		// Check field name 'StatusFinishOrder' first before field var 'x_StatusFinishOrder'
		$val = $CurrentForm->hasValue("StatusFinishOrder") ? $CurrentForm->getValue("StatusFinishOrder") : $CurrentForm->getValue("x_StatusFinishOrder");
		if (!$this->StatusFinishOrder->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->StatusFinishOrder->Visible = FALSE; // Disable update for API request
			else
				$this->StatusFinishOrder->setFormValue($val);
		}
		$this->StatusFinishOrder->setOldValue($CurrentForm->getValue("o_StatusFinishOrder"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->ID_Order->CurrentValue = $this->ID_Order->FormValue;
		$this->OrderDate->CurrentValue = $this->OrderDate->FormValue;
		$this->OrderDate->CurrentValue = UnFormatDateTime($this->OrderDate->CurrentValue, 7);
		$this->InvoiceNo->CurrentValue = $this->InvoiceNo->FormValue;
		$this->CusomterOrderNo->CurrentValue = $this->CusomterOrderNo->FormValue;
		$this->IdType->CurrentValue = $this->IdType->FormValue;
		$this->ID_Contact->CurrentValue = $this->ID_Contact->FormValue;
		$this->CreateUser->CurrentValue = $this->CreateUser->FormValue;
		$this->CreateDate->CurrentValue = $this->CreateDate->FormValue;
		$this->CreateDate->CurrentValue = UnFormatDateTime($this->CreateDate->CurrentValue, 11);
		$this->StatusLoad->CurrentValue = $this->StatusLoad->FormValue;
		$this->StatusFinishOrder->CurrentValue = $this->StatusFinishOrder->FormValue;
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
		$this->ID_Order->setDbValue($row['ID_Order']);
		$this->OrderDate->setDbValue($row['OrderDate']);
		$this->InvoiceNo->setDbValue($row['InvoiceNo']);
		$this->CusomterOrderNo->setDbValue($row['CusomterOrderNo']);
		$this->IdType->setDbValue($row['IdType']);
		$this->ID_Contact->setDbValue($row['ID_Contact']);
		if (array_key_exists('EV__ID_Contact', $rs->fields)) {
			$this->ID_Contact->VirtualValue = $rs->fields('EV__ID_Contact'); // Set up virtual field value
		} else {
			$this->ID_Contact->VirtualValue = ""; // Clear value
		}
		$this->CreateUser->setDbValue($row['CreateUser']);
		$this->CreateDate->setDbValue($row['CreateDate']);
		$this->StatusLoad->setDbValue($row['StatusLoad']);
		$this->StatusFinishOrder->setDbValue($row['StatusFinishOrder']);
		$this->DateTimefinishOrder->setDbValue($row['DateTimefinishOrder']);
		$this->UserFinishOrder->setDbValue($row['UserFinishOrder']);
		$this->UpdateDate->setDbValue($row['UpdateDate']);
		$this->UpdateUser->setDbValue($row['UpdateUser']);
		$this->PrintSubLable->setDbValue($row['PrintSubLable']);
		$this->Packing->setDbValue($row['Packing']);
		$this->FinishPacking->setDbValue($row['FinishPacking']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ID_Order'] = $this->ID_Order->CurrentValue;
		$row['OrderDate'] = $this->OrderDate->CurrentValue;
		$row['InvoiceNo'] = $this->InvoiceNo->CurrentValue;
		$row['CusomterOrderNo'] = $this->CusomterOrderNo->CurrentValue;
		$row['IdType'] = $this->IdType->CurrentValue;
		$row['ID_Contact'] = $this->ID_Contact->CurrentValue;
		$row['CreateUser'] = $this->CreateUser->CurrentValue;
		$row['CreateDate'] = $this->CreateDate->CurrentValue;
		$row['StatusLoad'] = $this->StatusLoad->CurrentValue;
		$row['StatusFinishOrder'] = $this->StatusFinishOrder->CurrentValue;
		$row['DateTimefinishOrder'] = $this->DateTimefinishOrder->CurrentValue;
		$row['UserFinishOrder'] = $this->UserFinishOrder->CurrentValue;
		$row['UpdateDate'] = $this->UpdateDate->CurrentValue;
		$row['UpdateUser'] = $this->UpdateUser->CurrentValue;
		$row['PrintSubLable'] = $this->PrintSubLable->CurrentValue;
		$row['Packing'] = $this->Packing->CurrentValue;
		$row['FinishPacking'] = $this->FinishPacking->CurrentValue;
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
				$this->ID_Order->CurrentValue = strval($arKeys[0]); // ID_Order
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
		// ID_Order

		$this->ID_Order->CellCssStyle = "white-space: nowrap;";

		// OrderDate
		$this->OrderDate->CellCssStyle = "white-space: nowrap;";

		// InvoiceNo
		$this->InvoiceNo->CellCssStyle = "white-space: nowrap;";

		// CusomterOrderNo
		$this->CusomterOrderNo->CellCssStyle = "white-space: nowrap;";

		// IdType
		$this->IdType->CellCssStyle = "white-space: nowrap;";

		// ID_Contact
		$this->ID_Contact->CellCssStyle = "white-space: nowrap;";

		// CreateUser
		$this->CreateUser->CellCssStyle = "white-space: nowrap;";

		// CreateDate
		$this->CreateDate->CellCssStyle = "white-space: nowrap;";

		// StatusLoad
		$this->StatusLoad->CellCssStyle = "white-space: nowrap;";

		// StatusFinishOrder
		$this->StatusFinishOrder->CellCssStyle = "white-space: nowrap;";

		// DateTimefinishOrder
		$this->DateTimefinishOrder->CellCssStyle = "white-space: nowrap;";

		// UserFinishOrder
		$this->UserFinishOrder->CellCssStyle = "white-space: nowrap;";

		// UpdateDate
		$this->UpdateDate->CellCssStyle = "white-space: nowrap;";

		// UpdateUser
		$this->UpdateUser->CellCssStyle = "white-space: nowrap;";

		// PrintSubLable
		// Packing
		// FinishPacking

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ID_Order
			$this->ID_Order->ViewValue = $this->ID_Order->CurrentValue;
			$this->ID_Order->CssClass = "font-weight-bold";
			$this->ID_Order->CellCssStyle .= "text-align: center;";
			$this->ID_Order->ViewCustomAttributes = "";

			// OrderDate
			$this->OrderDate->ViewValue = $this->OrderDate->CurrentValue;
			$this->OrderDate->ViewValue = FormatDateTime($this->OrderDate->ViewValue, 7);
			$this->OrderDate->CellCssStyle .= "text-align: center;";
			$this->OrderDate->ViewCustomAttributes = "";

			// InvoiceNo
			$this->InvoiceNo->ViewValue = $this->InvoiceNo->CurrentValue;
			$this->InvoiceNo->ViewCustomAttributes = "";

			// CusomterOrderNo
			$this->CusomterOrderNo->ViewValue = $this->CusomterOrderNo->CurrentValue;
			$this->CusomterOrderNo->ViewCustomAttributes = "";

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
			$this->IdType->CssClass = "font-weight-bold";
			$this->IdType->CellCssStyle .= "text-align: center;";
			$this->IdType->ViewCustomAttributes = "";

			// ID_Contact
			if ($this->ID_Contact->VirtualValue <> "") {
				$this->ID_Contact->ViewValue = $this->ID_Contact->VirtualValue;
			} else {
				$this->ID_Contact->ViewValue = $this->ID_Contact->CurrentValue;
			$curVal = strval($this->ID_Contact->CurrentValue);
			if ($curVal <> "") {
				$this->ID_Contact->ViewValue = $this->ID_Contact->lookupCacheOption($curVal);
				if ($this->ID_Contact->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ID_Contact`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ID_Contact->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->ID_Contact->ViewValue = $this->ID_Contact->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ID_Contact->ViewValue = $this->ID_Contact->CurrentValue;
					}
				}
			} else {
				$this->ID_Contact->ViewValue = NULL;
			}
			}
			$this->ID_Contact->ViewCustomAttributes = "";

			// CreateUser
			$this->CreateUser->ViewValue = $this->CreateUser->CurrentValue;
			$this->CreateUser->ViewCustomAttributes = "";

			// CreateDate
			$this->CreateDate->ViewValue = $this->CreateDate->CurrentValue;
			$this->CreateDate->ViewValue = FormatDateTime($this->CreateDate->ViewValue, 11);
			$this->CreateDate->ViewCustomAttributes = "";

			// StatusLoad
			if (strval($this->StatusLoad->CurrentValue) <> "") {
				$this->StatusLoad->ViewValue = $this->StatusLoad->optionCaption($this->StatusLoad->CurrentValue);
			} else {
				$this->StatusLoad->ViewValue = NULL;
			}
			$this->StatusLoad->CellCssStyle .= "text-align: center;";
			$this->StatusLoad->ViewCustomAttributes = "";

			// StatusFinishOrder
			if (strval($this->StatusFinishOrder->CurrentValue) <> "") {
				$this->StatusFinishOrder->ViewValue = $this->StatusFinishOrder->optionCaption($this->StatusFinishOrder->CurrentValue);
			} else {
				$this->StatusFinishOrder->ViewValue = NULL;
			}
			$this->StatusFinishOrder->CellCssStyle .= "text-align: center;";
			$this->StatusFinishOrder->ViewCustomAttributes = "";

			// ID_Order
			$this->ID_Order->LinkCustomAttributes = "";
			$this->ID_Order->HrefValue = "";
			$this->ID_Order->TooltipValue = "";
			if (!$this->isExport())
				$this->ID_Order->ViewValue = $this->highlightValue($this->ID_Order);

			// OrderDate
			$this->OrderDate->LinkCustomAttributes = "";
			$this->OrderDate->HrefValue = "";
			$this->OrderDate->TooltipValue = "";

			// InvoiceNo
			$this->InvoiceNo->LinkCustomAttributes = "";
			$this->InvoiceNo->HrefValue = "";
			$this->InvoiceNo->TooltipValue = "";
			if (!$this->isExport())
				$this->InvoiceNo->ViewValue = $this->highlightValue($this->InvoiceNo);

			// CusomterOrderNo
			$this->CusomterOrderNo->LinkCustomAttributes = "";
			$this->CusomterOrderNo->HrefValue = "";
			$this->CusomterOrderNo->TooltipValue = "";
			if (!$this->isExport())
				$this->CusomterOrderNo->ViewValue = $this->highlightValue($this->CusomterOrderNo);

			// IdType
			$this->IdType->LinkCustomAttributes = "";
			$this->IdType->HrefValue = "";
			$this->IdType->TooltipValue = "";

			// ID_Contact
			$this->ID_Contact->LinkCustomAttributes = "";
			$this->ID_Contact->HrefValue = "";
			$this->ID_Contact->TooltipValue = "";

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

			// StatusLoad
			$this->StatusLoad->LinkCustomAttributes = "";
			$this->StatusLoad->HrefValue = "";
			$this->StatusLoad->TooltipValue = "";

			// StatusFinishOrder
			$this->StatusFinishOrder->LinkCustomAttributes = "";
			$this->StatusFinishOrder->HrefValue = "";
			$this->StatusFinishOrder->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// ID_Order
			// OrderDate

			$this->OrderDate->EditAttrs["class"] = "form-control";
			$this->OrderDate->EditCustomAttributes = "";
			$this->OrderDate->EditValue = HtmlEncode(FormatDateTime($this->OrderDate->CurrentValue, 7));
			$this->OrderDate->PlaceHolder = RemoveHtml($this->OrderDate->caption());

			// InvoiceNo
			$this->InvoiceNo->EditAttrs["class"] = "form-control";
			$this->InvoiceNo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->InvoiceNo->CurrentValue = HtmlDecode($this->InvoiceNo->CurrentValue);
			$this->InvoiceNo->EditValue = HtmlEncode($this->InvoiceNo->CurrentValue);
			$this->InvoiceNo->PlaceHolder = RemoveHtml($this->InvoiceNo->caption());

			// CusomterOrderNo
			$this->CusomterOrderNo->EditAttrs["class"] = "form-control";
			$this->CusomterOrderNo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->CusomterOrderNo->CurrentValue = HtmlDecode($this->CusomterOrderNo->CurrentValue);
			$this->CusomterOrderNo->EditValue = HtmlEncode($this->CusomterOrderNo->CurrentValue);
			$this->CusomterOrderNo->PlaceHolder = RemoveHtml($this->CusomterOrderNo->caption());

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

			// ID_Contact
			$this->ID_Contact->EditAttrs["class"] = "form-control";
			$this->ID_Contact->EditCustomAttributes = "";
			$this->ID_Contact->EditValue = HtmlEncode($this->ID_Contact->CurrentValue);
			$curVal = strval($this->ID_Contact->CurrentValue);
			if ($curVal <> "") {
				$this->ID_Contact->EditValue = $this->ID_Contact->lookupCacheOption($curVal);
				if ($this->ID_Contact->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ID_Contact`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ID_Contact->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->ID_Contact->EditValue = $this->ID_Contact->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ID_Contact->EditValue = HtmlEncode($this->ID_Contact->CurrentValue);
					}
				}
			} else {
				$this->ID_Contact->EditValue = NULL;
			}
			$this->ID_Contact->PlaceHolder = RemoveHtml($this->ID_Contact->caption());

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

			// StatusLoad
			$this->StatusLoad->EditAttrs["class"] = "form-control";
			$this->StatusLoad->EditCustomAttributes = "";
			$this->StatusLoad->EditValue = $this->StatusLoad->options(TRUE);

			// StatusFinishOrder
			$this->StatusFinishOrder->EditAttrs["class"] = "form-control";
			$this->StatusFinishOrder->EditCustomAttributes = "";
			$this->StatusFinishOrder->EditValue = $this->StatusFinishOrder->options(TRUE);

			// Add refer script
			// ID_Order

			$this->ID_Order->LinkCustomAttributes = "";
			$this->ID_Order->HrefValue = "";

			// OrderDate
			$this->OrderDate->LinkCustomAttributes = "";
			$this->OrderDate->HrefValue = "";

			// InvoiceNo
			$this->InvoiceNo->LinkCustomAttributes = "";
			$this->InvoiceNo->HrefValue = "";

			// CusomterOrderNo
			$this->CusomterOrderNo->LinkCustomAttributes = "";
			$this->CusomterOrderNo->HrefValue = "";

			// IdType
			$this->IdType->LinkCustomAttributes = "";
			$this->IdType->HrefValue = "";

			// ID_Contact
			$this->ID_Contact->LinkCustomAttributes = "";
			$this->ID_Contact->HrefValue = "";

			// CreateUser
			$this->CreateUser->LinkCustomAttributes = "";
			$this->CreateUser->HrefValue = "";

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";

			// StatusLoad
			$this->StatusLoad->LinkCustomAttributes = "";
			$this->StatusLoad->HrefValue = "";

			// StatusFinishOrder
			$this->StatusFinishOrder->LinkCustomAttributes = "";
			$this->StatusFinishOrder->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// ID_Order
			$this->ID_Order->EditAttrs["class"] = "form-control";
			$this->ID_Order->EditCustomAttributes = "";
			$this->ID_Order->EditValue = $this->ID_Order->CurrentValue;
			$this->ID_Order->CssClass = "font-weight-bold";
			$this->ID_Order->CellCssStyle .= "text-align: center;";
			$this->ID_Order->ViewCustomAttributes = "";

			// OrderDate
			$this->OrderDate->EditAttrs["class"] = "form-control";
			$this->OrderDate->EditCustomAttributes = "";
			$this->OrderDate->EditValue = HtmlEncode(FormatDateTime($this->OrderDate->CurrentValue, 7));
			$this->OrderDate->PlaceHolder = RemoveHtml($this->OrderDate->caption());

			// InvoiceNo
			$this->InvoiceNo->EditAttrs["class"] = "form-control";
			$this->InvoiceNo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->InvoiceNo->CurrentValue = HtmlDecode($this->InvoiceNo->CurrentValue);
			$this->InvoiceNo->EditValue = HtmlEncode($this->InvoiceNo->CurrentValue);
			$this->InvoiceNo->PlaceHolder = RemoveHtml($this->InvoiceNo->caption());

			// CusomterOrderNo
			$this->CusomterOrderNo->EditAttrs["class"] = "form-control";
			$this->CusomterOrderNo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->CusomterOrderNo->CurrentValue = HtmlDecode($this->CusomterOrderNo->CurrentValue);
			$this->CusomterOrderNo->EditValue = HtmlEncode($this->CusomterOrderNo->CurrentValue);
			$this->CusomterOrderNo->PlaceHolder = RemoveHtml($this->CusomterOrderNo->caption());

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

			// ID_Contact
			$this->ID_Contact->EditAttrs["class"] = "form-control";
			$this->ID_Contact->EditCustomAttributes = "";
			$this->ID_Contact->EditValue = HtmlEncode($this->ID_Contact->CurrentValue);
			$curVal = strval($this->ID_Contact->CurrentValue);
			if ($curVal <> "") {
				$this->ID_Contact->EditValue = $this->ID_Contact->lookupCacheOption($curVal);
				if ($this->ID_Contact->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ID_Contact`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ID_Contact->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->ID_Contact->EditValue = $this->ID_Contact->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ID_Contact->EditValue = HtmlEncode($this->ID_Contact->CurrentValue);
					}
				}
			} else {
				$this->ID_Contact->EditValue = NULL;
			}
			$this->ID_Contact->PlaceHolder = RemoveHtml($this->ID_Contact->caption());

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

			// StatusLoad
			$this->StatusLoad->EditAttrs["class"] = "form-control";
			$this->StatusLoad->EditCustomAttributes = "";
			$this->StatusLoad->EditValue = $this->StatusLoad->options(TRUE);

			// StatusFinishOrder
			$this->StatusFinishOrder->EditAttrs["class"] = "form-control";
			$this->StatusFinishOrder->EditCustomAttributes = "";
			$this->StatusFinishOrder->EditValue = $this->StatusFinishOrder->options(TRUE);

			// Edit refer script
			// ID_Order

			$this->ID_Order->LinkCustomAttributes = "";
			$this->ID_Order->HrefValue = "";
			$this->ID_Order->TooltipValue = "";

			// OrderDate
			$this->OrderDate->LinkCustomAttributes = "";
			$this->OrderDate->HrefValue = "";

			// InvoiceNo
			$this->InvoiceNo->LinkCustomAttributes = "";
			$this->InvoiceNo->HrefValue = "";

			// CusomterOrderNo
			$this->CusomterOrderNo->LinkCustomAttributes = "";
			$this->CusomterOrderNo->HrefValue = "";

			// IdType
			$this->IdType->LinkCustomAttributes = "";
			$this->IdType->HrefValue = "";

			// ID_Contact
			$this->ID_Contact->LinkCustomAttributes = "";
			$this->ID_Contact->HrefValue = "";

			// CreateUser
			$this->CreateUser->LinkCustomAttributes = "";
			$this->CreateUser->HrefValue = "";
			$this->CreateUser->TooltipValue = "";

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";
			$this->CreateDate->TooltipValue = "";

			// StatusLoad
			$this->StatusLoad->LinkCustomAttributes = "";
			$this->StatusLoad->HrefValue = "";

			// StatusFinishOrder
			$this->StatusFinishOrder->LinkCustomAttributes = "";
			$this->StatusFinishOrder->HrefValue = "";
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
		if ($this->ID_Order->Required) {
			if (!$this->ID_Order->IsDetailKey && $this->ID_Order->FormValue != NULL && $this->ID_Order->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Order->caption(), $this->ID_Order->RequiredErrorMessage));
			}
		}
		if ($this->OrderDate->Required) {
			if (!$this->OrderDate->IsDetailKey && $this->OrderDate->FormValue != NULL && $this->OrderDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OrderDate->caption(), $this->OrderDate->RequiredErrorMessage));
			}
		}
		if (!CheckEuroDate($this->OrderDate->FormValue)) {
			AddMessage($FormError, $this->OrderDate->errorMessage());
		}
		if ($this->InvoiceNo->Required) {
			if (!$this->InvoiceNo->IsDetailKey && $this->InvoiceNo->FormValue != NULL && $this->InvoiceNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->InvoiceNo->caption(), $this->InvoiceNo->RequiredErrorMessage));
			}
		}
		if ($this->CusomterOrderNo->Required) {
			if (!$this->CusomterOrderNo->IsDetailKey && $this->CusomterOrderNo->FormValue != NULL && $this->CusomterOrderNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CusomterOrderNo->caption(), $this->CusomterOrderNo->RequiredErrorMessage));
			}
		}
		if ($this->IdType->Required) {
			if (!$this->IdType->IsDetailKey && $this->IdType->FormValue != NULL && $this->IdType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IdType->caption(), $this->IdType->RequiredErrorMessage));
			}
		}
		if ($this->ID_Contact->Required) {
			if (!$this->ID_Contact->IsDetailKey && $this->ID_Contact->FormValue != NULL && $this->ID_Contact->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Contact->caption(), $this->ID_Contact->RequiredErrorMessage));
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
		if ($this->StatusLoad->Required) {
			if (!$this->StatusLoad->IsDetailKey && $this->StatusLoad->FormValue != NULL && $this->StatusLoad->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->StatusLoad->caption(), $this->StatusLoad->RequiredErrorMessage));
			}
		}
		if ($this->StatusFinishOrder->Required) {
			if (!$this->StatusFinishOrder->IsDetailKey && $this->StatusFinishOrder->FormValue != NULL && $this->StatusFinishOrder->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->StatusFinishOrder->caption(), $this->StatusFinishOrder->RequiredErrorMessage));
			}
		}
		if ($this->DateTimefinishOrder->Required) {
			if (!$this->DateTimefinishOrder->IsDetailKey && $this->DateTimefinishOrder->FormValue != NULL && $this->DateTimefinishOrder->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateTimefinishOrder->caption(), $this->DateTimefinishOrder->RequiredErrorMessage));
			}
		}
		if ($this->UserFinishOrder->Required) {
			if (!$this->UserFinishOrder->IsDetailKey && $this->UserFinishOrder->FormValue != NULL && $this->UserFinishOrder->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UserFinishOrder->caption(), $this->UserFinishOrder->RequiredErrorMessage));
			}
		}
		if ($this->UpdateDate->Required) {
			if (!$this->UpdateDate->IsDetailKey && $this->UpdateDate->FormValue != NULL && $this->UpdateDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UpdateDate->caption(), $this->UpdateDate->RequiredErrorMessage));
			}
		}
		if ($this->UpdateUser->Required) {
			if (!$this->UpdateUser->IsDetailKey && $this->UpdateUser->FormValue != NULL && $this->UpdateUser->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UpdateUser->caption(), $this->UpdateUser->RequiredErrorMessage));
			}
		}
		if ($this->PrintSubLable->Required) {
			if (!$this->PrintSubLable->IsDetailKey && $this->PrintSubLable->FormValue != NULL && $this->PrintSubLable->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PrintSubLable->caption(), $this->PrintSubLable->RequiredErrorMessage));
			}
		}
		if ($this->Packing->Required) {
			if (!$this->Packing->IsDetailKey && $this->Packing->FormValue != NULL && $this->Packing->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Packing->caption(), $this->Packing->RequiredErrorMessage));
			}
		}
		if ($this->FinishPacking->Required) {
			if (!$this->FinishPacking->IsDetailKey && $this->FinishPacking->FormValue != NULL && $this->FinishPacking->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FinishPacking->caption(), $this->FinishPacking->RequiredErrorMessage));
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
				$thisKey .= $row['ID_Order'];
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

			// OrderDate
			$this->OrderDate->setDbValueDef($rsnew, UnFormatDateTime($this->OrderDate->CurrentValue, 7), NULL, $this->OrderDate->ReadOnly);

			// InvoiceNo
			$this->InvoiceNo->setDbValueDef($rsnew, $this->InvoiceNo->CurrentValue, NULL, $this->InvoiceNo->ReadOnly);

			// CusomterOrderNo
			$this->CusomterOrderNo->setDbValueDef($rsnew, $this->CusomterOrderNo->CurrentValue, NULL, $this->CusomterOrderNo->ReadOnly);

			// IdType
			$this->IdType->setDbValueDef($rsnew, $this->IdType->CurrentValue, NULL, $this->IdType->ReadOnly);

			// ID_Contact
			$this->ID_Contact->setDbValueDef($rsnew, $this->ID_Contact->CurrentValue, NULL, $this->ID_Contact->ReadOnly);

			// StatusLoad
			$this->StatusLoad->setDbValueDef($rsnew, $this->StatusLoad->CurrentValue, NULL, $this->StatusLoad->ReadOnly);

			// StatusFinishOrder
			$this->StatusFinishOrder->setDbValueDef($rsnew, $this->StatusFinishOrder->CurrentValue, NULL, $this->StatusFinishOrder->ReadOnly);

			// Check referential integrity for master table 'tbl_history_pick'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_tbl_history_pick();
			$keyValue = isset($rsnew['ID_Order']) ? $rsnew['ID_Order'] : $rsold['ID_Order'];
			if (strval($keyValue) <> "") {
				$masterFilter = str_replace("@ID_Order@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["tbl_history_pick"]))
					$GLOBALS["tbl_history_pick"] = new tbl_history_pick();
				$rsmaster = $GLOBALS["tbl_history_pick"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "tbl_history_pick", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

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
			if ($this->getCurrentMasterTable() == "tbl_history_pick") {
				$this->ID_Order->CurrentValue = $this->ID_Order->getSessionValue();
			}

		// Check referential integrity for master table 'tbl_history_pick'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_tbl_history_pick();
		if (strval($this->ID_Order->CurrentValue) <> "") {
			$masterFilter = str_replace("@ID_Order@", AdjustSql($this->ID_Order->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["tbl_history_pick"]))
				$GLOBALS["tbl_history_pick"] = new tbl_history_pick();
			$rsmaster = $GLOBALS["tbl_history_pick"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "tbl_history_pick", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = &$this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// OrderDate
		$this->OrderDate->setDbValueDef($rsnew, UnFormatDateTime($this->OrderDate->CurrentValue, 7), NULL, FALSE);

		// InvoiceNo
		$this->InvoiceNo->setDbValueDef($rsnew, $this->InvoiceNo->CurrentValue, NULL, FALSE);

		// CusomterOrderNo
		$this->CusomterOrderNo->setDbValueDef($rsnew, $this->CusomterOrderNo->CurrentValue, NULL, FALSE);

		// IdType
		$this->IdType->setDbValueDef($rsnew, $this->IdType->CurrentValue, NULL, FALSE);

		// ID_Contact
		$this->ID_Contact->setDbValueDef($rsnew, $this->ID_Contact->CurrentValue, NULL, FALSE);

		// CreateUser
		$this->CreateUser->setDbValueDef($rsnew, $this->CreateUser->CurrentValue, NULL, FALSE);

		// CreateDate
		$this->CreateDate->setDbValueDef($rsnew, UnFormatDateTime($this->CreateDate->CurrentValue, 11), NULL, FALSE);

		// StatusLoad
		$this->StatusLoad->setDbValueDef($rsnew, $this->StatusLoad->CurrentValue, NULL, strval($this->StatusLoad->CurrentValue) == "");

		// StatusFinishOrder
		$this->StatusFinishOrder->setDbValueDef($rsnew, $this->StatusFinishOrder->CurrentValue, NULL, strval($this->StatusFinishOrder->CurrentValue) == "");

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
		if ($masterTblVar == "tbl_history_pick") {
			$this->ID_Order->Visible = FALSE;
			if ($GLOBALS["tbl_history_pick"]->EventCancelled)
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
						case "x_IdType":
							break;
						case "x_ID_Contact":
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