<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Page class
 */
class tbl_order_po_inv_grid extends tbl_order_po_inv
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{004E2122-9CCA-46AA-835C-0778C5A080BC}";

	// Table name
	public $TableName = 'tbl_order_po_inv';

	// Page object name
	public $PageObjName = "tbl_order_po_inv_grid";

	// Grid form hidden field names
	public $FormName = "ftbl_order_po_invgrid";
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

		// Table object (tbl_order_po_inv)
		if (!isset($GLOBALS["tbl_order_po_inv"]) || get_class($GLOBALS["tbl_order_po_inv"]) == PROJECT_NAMESPACE . "tbl_order_po_inv") {
			$GLOBALS["tbl_order_po_inv"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["tbl_order_po_inv"];

		}
		$this->AddUrl = "tbl_order_po_invadd.php";
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (tbl_user)
		if (!isset($GLOBALS['tbl_user']))
			$GLOBALS['tbl_user'] = new tbl_user();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_order_po_inv');

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
		global $EXPORT, $tbl_order_po_inv;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_order_po_inv);
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
			$key .= @$ar['ID_PoInv'];
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
			$this->ID_PoInv->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->PO_InputDate->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->PO_InputUser->Visible = FALSE;
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
		$this->ID_PoInv->Visible = FALSE;
		$this->OrderNo->Visible = FALSE;
		$this->Code->setVisibility();
		$this->PalletNo->setVisibility();
		$this->DateIn->setVisibility();
		$this->PCS_In->setVisibility();
		$this->PCS_Out->setVisibility();
		$this->PO_No->setVisibility();
		$this->INV_No->setVisibility();
		$this->PO_InputDate->setVisibility();
		$this->PO_InputUser->setVisibility();
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
			$this->ID_PoInv->setFormValue($arKeyFlds[0]);
			if (!is_numeric($this->ID_PoInv->FormValue))
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
					$key .= $this->ID_PoInv->CurrentValue;

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
		if ($CurrentForm->hasValue("x_PalletNo") && $CurrentForm->hasValue("o_PalletNo") && $this->PalletNo->CurrentValue <> $this->PalletNo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DateIn") && $CurrentForm->hasValue("o_DateIn") && $this->DateIn->CurrentValue <> $this->DateIn->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PCS_In") && $CurrentForm->hasValue("o_PCS_In") && $this->PCS_In->CurrentValue <> $this->PCS_In->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PCS_Out") && $CurrentForm->hasValue("o_PCS_Out") && $this->PCS_Out->CurrentValue <> $this->PCS_Out->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PO_No") && $CurrentForm->hasValue("o_PO_No") && $this->PO_No->CurrentValue <> $this->PO_No->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_INV_No") && $CurrentForm->hasValue("o_INV_No") && $this->INV_No->CurrentValue <> $this->INV_No->OldValue)
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
				$this->DateIn->setSort("ASC");
				$this->Code->setSort("ASC");
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
				$this->OrderNo->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
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
				if (is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
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
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->ID_PoInv->CurrentValue . "\">";
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
		$key .= $rs->fields('ID_PoInv');
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
		$this->ID_PoInv->CurrentValue = NULL;
		$this->ID_PoInv->OldValue = $this->ID_PoInv->CurrentValue;
		$this->OrderNo->CurrentValue = NULL;
		$this->OrderNo->OldValue = $this->OrderNo->CurrentValue;
		$this->Code->CurrentValue = NULL;
		$this->Code->OldValue = $this->Code->CurrentValue;
		$this->PalletNo->CurrentValue = NULL;
		$this->PalletNo->OldValue = $this->PalletNo->CurrentValue;
		$this->DateIn->CurrentValue = NULL;
		$this->DateIn->OldValue = $this->DateIn->CurrentValue;
		$this->PCS_In->CurrentValue = NULL;
		$this->PCS_In->OldValue = $this->PCS_In->CurrentValue;
		$this->PCS_Out->CurrentValue = NULL;
		$this->PCS_Out->OldValue = $this->PCS_Out->CurrentValue;
		$this->PO_No->CurrentValue = NULL;
		$this->PO_No->OldValue = $this->PO_No->CurrentValue;
		$this->INV_No->CurrentValue = NULL;
		$this->INV_No->OldValue = $this->INV_No->CurrentValue;
		$this->PO_InputDate->CurrentValue = NULL;
		$this->PO_InputDate->OldValue = $this->PO_InputDate->CurrentValue;
		$this->PO_InputUser->CurrentValue = NULL;
		$this->PO_InputUser->OldValue = $this->PO_InputUser->CurrentValue;
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

		// Check field name 'PalletNo' first before field var 'x_PalletNo'
		$val = $CurrentForm->hasValue("PalletNo") ? $CurrentForm->getValue("PalletNo") : $CurrentForm->getValue("x_PalletNo");
		if (!$this->PalletNo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PalletNo->Visible = FALSE; // Disable update for API request
			else
				$this->PalletNo->setFormValue($val);
		}
		$this->PalletNo->setOldValue($CurrentForm->getValue("o_PalletNo"));

		// Check field name 'DateIn' first before field var 'x_DateIn'
		$val = $CurrentForm->hasValue("DateIn") ? $CurrentForm->getValue("DateIn") : $CurrentForm->getValue("x_DateIn");
		if (!$this->DateIn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DateIn->Visible = FALSE; // Disable update for API request
			else
				$this->DateIn->setFormValue($val);
			$this->DateIn->CurrentValue = UnFormatDateTime($this->DateIn->CurrentValue, 7);
		}
		$this->DateIn->setOldValue($CurrentForm->getValue("o_DateIn"));

		// Check field name 'PCS_In' first before field var 'x_PCS_In'
		$val = $CurrentForm->hasValue("PCS_In") ? $CurrentForm->getValue("PCS_In") : $CurrentForm->getValue("x_PCS_In");
		if (!$this->PCS_In->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PCS_In->Visible = FALSE; // Disable update for API request
			else
				$this->PCS_In->setFormValue($val);
		}
		$this->PCS_In->setOldValue($CurrentForm->getValue("o_PCS_In"));

		// Check field name 'PCS_Out' first before field var 'x_PCS_Out'
		$val = $CurrentForm->hasValue("PCS_Out") ? $CurrentForm->getValue("PCS_Out") : $CurrentForm->getValue("x_PCS_Out");
		if (!$this->PCS_Out->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PCS_Out->Visible = FALSE; // Disable update for API request
			else
				$this->PCS_Out->setFormValue($val);
		}
		$this->PCS_Out->setOldValue($CurrentForm->getValue("o_PCS_Out"));

		// Check field name 'PO_No' first before field var 'x_PO_No'
		$val = $CurrentForm->hasValue("PO_No") ? $CurrentForm->getValue("PO_No") : $CurrentForm->getValue("x_PO_No");
		if (!$this->PO_No->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PO_No->Visible = FALSE; // Disable update for API request
			else
				$this->PO_No->setFormValue($val);
		}
		$this->PO_No->setOldValue($CurrentForm->getValue("o_PO_No"));

		// Check field name 'INV_No' first before field var 'x_INV_No'
		$val = $CurrentForm->hasValue("INV_No") ? $CurrentForm->getValue("INV_No") : $CurrentForm->getValue("x_INV_No");
		if (!$this->INV_No->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->INV_No->Visible = FALSE; // Disable update for API request
			else
				$this->INV_No->setFormValue($val);
		}
		$this->INV_No->setOldValue($CurrentForm->getValue("o_INV_No"));

		// Check field name 'PO_InputDate' first before field var 'x_PO_InputDate'
		$val = $CurrentForm->hasValue("PO_InputDate") ? $CurrentForm->getValue("PO_InputDate") : $CurrentForm->getValue("x_PO_InputDate");
		if (!$this->PO_InputDate->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PO_InputDate->Visible = FALSE; // Disable update for API request
			else
				$this->PO_InputDate->setFormValue($val);
			$this->PO_InputDate->CurrentValue = UnFormatDateTime($this->PO_InputDate->CurrentValue, 11);
		}
		$this->PO_InputDate->setOldValue($CurrentForm->getValue("o_PO_InputDate"));

		// Check field name 'PO_InputUser' first before field var 'x_PO_InputUser'
		$val = $CurrentForm->hasValue("PO_InputUser") ? $CurrentForm->getValue("PO_InputUser") : $CurrentForm->getValue("x_PO_InputUser");
		if (!$this->PO_InputUser->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PO_InputUser->Visible = FALSE; // Disable update for API request
			else
				$this->PO_InputUser->setFormValue($val);
		}
		$this->PO_InputUser->setOldValue($CurrentForm->getValue("o_PO_InputUser"));

		// Check field name 'ID_PoInv' first before field var 'x_ID_PoInv'
		$val = $CurrentForm->hasValue("ID_PoInv") ? $CurrentForm->getValue("ID_PoInv") : $CurrentForm->getValue("x_ID_PoInv");
		if (!$this->ID_PoInv->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->ID_PoInv->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->ID_PoInv->CurrentValue = $this->ID_PoInv->FormValue;
		$this->Code->CurrentValue = $this->Code->FormValue;
		$this->PalletNo->CurrentValue = $this->PalletNo->FormValue;
		$this->DateIn->CurrentValue = $this->DateIn->FormValue;
		$this->DateIn->CurrentValue = UnFormatDateTime($this->DateIn->CurrentValue, 7);
		$this->PCS_In->CurrentValue = $this->PCS_In->FormValue;
		$this->PCS_Out->CurrentValue = $this->PCS_Out->FormValue;
		$this->PO_No->CurrentValue = $this->PO_No->FormValue;
		$this->INV_No->CurrentValue = $this->INV_No->FormValue;
		$this->PO_InputDate->CurrentValue = $this->PO_InputDate->FormValue;
		$this->PO_InputDate->CurrentValue = UnFormatDateTime($this->PO_InputDate->CurrentValue, 11);
		$this->PO_InputUser->CurrentValue = $this->PO_InputUser->FormValue;
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
		$this->ID_PoInv->setDbValue($row['ID_PoInv']);
		$this->OrderNo->setDbValue($row['OrderNo']);
		$this->Code->setDbValue($row['Code']);
		$this->PalletNo->setDbValue($row['PalletNo']);
		$this->DateIn->setDbValue($row['DateIn']);
		$this->PCS_In->setDbValue($row['PCS_In']);
		$this->PCS_Out->setDbValue($row['PCS_Out']);
		$this->PO_No->setDbValue($row['PO_No']);
		$this->INV_No->setDbValue($row['INV_No']);
		$this->PO_InputDate->setDbValue($row['PO_InputDate']);
		$this->PO_InputUser->setDbValue($row['PO_InputUser']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ID_PoInv'] = $this->ID_PoInv->CurrentValue;
		$row['OrderNo'] = $this->OrderNo->CurrentValue;
		$row['Code'] = $this->Code->CurrentValue;
		$row['PalletNo'] = $this->PalletNo->CurrentValue;
		$row['DateIn'] = $this->DateIn->CurrentValue;
		$row['PCS_In'] = $this->PCS_In->CurrentValue;
		$row['PCS_Out'] = $this->PCS_Out->CurrentValue;
		$row['PO_No'] = $this->PO_No->CurrentValue;
		$row['INV_No'] = $this->INV_No->CurrentValue;
		$row['PO_InputDate'] = $this->PO_InputDate->CurrentValue;
		$row['PO_InputUser'] = $this->PO_InputUser->CurrentValue;
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
				$this->ID_PoInv->CurrentValue = strval($arKeys[0]); // ID_PoInv
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
		// ID_PoInv

		$this->ID_PoInv->CellCssStyle = "white-space: nowrap;";

		// OrderNo
		$this->OrderNo->CellCssStyle = "white-space: nowrap;";

		// Code
		$this->Code->CellCssStyle = "white-space: nowrap;";

		// PalletNo
		$this->PalletNo->CellCssStyle = "white-space: nowrap;";

		// DateIn
		$this->DateIn->CellCssStyle = "white-space: nowrap;";

		// PCS_In
		$this->PCS_In->CellCssStyle = "white-space: nowrap;";

		// PCS_Out
		$this->PCS_Out->CellCssStyle = "white-space: nowrap;";

		// PO_No
		$this->PO_No->CellCssStyle = "white-space: nowrap;";

		// INV_No
		$this->INV_No->CellCssStyle = "white-space: nowrap;";

		// PO_InputDate
		$this->PO_InputDate->CellCssStyle = "white-space: nowrap;";

		// PO_InputUser
		$this->PO_InputUser->CellCssStyle = "white-space: nowrap;";
		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// Code
			$this->Code->ViewValue = $this->Code->CurrentValue;
			$this->Code->ViewCustomAttributes = "";

			// PalletNo
			$this->PalletNo->ViewValue = $this->PalletNo->CurrentValue;
			$this->PalletNo->CellCssStyle .= "text-align: center;";
			$this->PalletNo->ViewCustomAttributes = "";

			// DateIn
			$this->DateIn->ViewValue = $this->DateIn->CurrentValue;
			$this->DateIn->ViewValue = FormatDateTime($this->DateIn->ViewValue, 7);
			$this->DateIn->CellCssStyle .= "text-align: center;";
			$this->DateIn->ViewCustomAttributes = "";

			// PCS_In
			$this->PCS_In->ViewValue = $this->PCS_In->CurrentValue;
			$this->PCS_In->ViewValue = FormatNumber($this->PCS_In->ViewValue, 0, -2, -2, -2);
			$this->PCS_In->CellCssStyle .= "text-align: right;";
			$this->PCS_In->ViewCustomAttributes = "";

			// PCS_Out
			$this->PCS_Out->ViewValue = $this->PCS_Out->CurrentValue;
			$this->PCS_Out->ViewValue = FormatNumber($this->PCS_Out->ViewValue, 0, -2, -2, -2);
			$this->PCS_Out->CellCssStyle .= "text-align: right;";
			$this->PCS_Out->ViewCustomAttributes = "";

			// PO_No
			$this->PO_No->ViewValue = $this->PO_No->CurrentValue;
			$this->PO_No->ViewCustomAttributes = "";

			// INV_No
			$this->INV_No->ViewValue = $this->INV_No->CurrentValue;
			$this->INV_No->ViewCustomAttributes = "";

			// PO_InputDate
			$this->PO_InputDate->ViewValue = $this->PO_InputDate->CurrentValue;
			$this->PO_InputDate->ViewValue = FormatDateTime($this->PO_InputDate->ViewValue, 11);
			$this->PO_InputDate->CellCssStyle .= "text-align: center;";
			$this->PO_InputDate->ViewCustomAttributes = "";

			// PO_InputUser
			$this->PO_InputUser->ViewValue = $this->PO_InputUser->CurrentValue;
			$this->PO_InputUser->ViewCustomAttributes = "";

			// Code
			$this->Code->LinkCustomAttributes = "";
			$this->Code->HrefValue = "";
			$this->Code->TooltipValue = "";

			// PalletNo
			$this->PalletNo->LinkCustomAttributes = "";
			$this->PalletNo->HrefValue = "";
			$this->PalletNo->TooltipValue = "";

			// DateIn
			$this->DateIn->LinkCustomAttributes = "";
			$this->DateIn->HrefValue = "";
			$this->DateIn->TooltipValue = "";

			// PCS_In
			$this->PCS_In->LinkCustomAttributes = "";
			$this->PCS_In->HrefValue = "";
			$this->PCS_In->TooltipValue = "";

			// PCS_Out
			$this->PCS_Out->LinkCustomAttributes = "";
			$this->PCS_Out->HrefValue = "";
			$this->PCS_Out->TooltipValue = "";

			// PO_No
			$this->PO_No->LinkCustomAttributes = "";
			$this->PO_No->HrefValue = "";
			$this->PO_No->TooltipValue = "";

			// INV_No
			$this->INV_No->LinkCustomAttributes = "";
			$this->INV_No->HrefValue = "";
			$this->INV_No->TooltipValue = "";

			// PO_InputDate
			$this->PO_InputDate->LinkCustomAttributes = "";
			$this->PO_InputDate->HrefValue = "";
			$this->PO_InputDate->TooltipValue = "";

			// PO_InputUser
			$this->PO_InputUser->LinkCustomAttributes = "";
			$this->PO_InputUser->HrefValue = "";
			$this->PO_InputUser->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// Code
			$this->Code->EditAttrs["class"] = "form-control";
			$this->Code->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Code->CurrentValue = HtmlDecode($this->Code->CurrentValue);
			$this->Code->EditValue = HtmlEncode($this->Code->CurrentValue);
			$this->Code->PlaceHolder = RemoveHtml($this->Code->caption());

			// PalletNo
			$this->PalletNo->EditAttrs["class"] = "form-control";
			$this->PalletNo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->PalletNo->CurrentValue = HtmlDecode($this->PalletNo->CurrentValue);
			$this->PalletNo->EditValue = HtmlEncode($this->PalletNo->CurrentValue);
			$this->PalletNo->PlaceHolder = RemoveHtml($this->PalletNo->caption());

			// DateIn
			$this->DateIn->EditAttrs["class"] = "form-control";
			$this->DateIn->EditCustomAttributes = "";
			$this->DateIn->EditValue = HtmlEncode(FormatDateTime($this->DateIn->CurrentValue, 7));
			$this->DateIn->PlaceHolder = RemoveHtml($this->DateIn->caption());

			// PCS_In
			$this->PCS_In->EditAttrs["class"] = "form-control";
			$this->PCS_In->EditCustomAttributes = "";
			$this->PCS_In->EditValue = HtmlEncode($this->PCS_In->CurrentValue);
			$this->PCS_In->PlaceHolder = RemoveHtml($this->PCS_In->caption());

			// PCS_Out
			$this->PCS_Out->EditAttrs["class"] = "form-control";
			$this->PCS_Out->EditCustomAttributes = "";
			$this->PCS_Out->EditValue = HtmlEncode($this->PCS_Out->CurrentValue);
			$this->PCS_Out->PlaceHolder = RemoveHtml($this->PCS_Out->caption());

			// PO_No
			$this->PO_No->EditAttrs["class"] = "form-control";
			$this->PO_No->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->PO_No->CurrentValue = HtmlDecode($this->PO_No->CurrentValue);
			$this->PO_No->EditValue = HtmlEncode($this->PO_No->CurrentValue);
			$this->PO_No->PlaceHolder = RemoveHtml($this->PO_No->caption());

			// INV_No
			$this->INV_No->EditAttrs["class"] = "form-control";
			$this->INV_No->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->INV_No->CurrentValue = HtmlDecode($this->INV_No->CurrentValue);
			$this->INV_No->EditValue = HtmlEncode($this->INV_No->CurrentValue);
			$this->INV_No->PlaceHolder = RemoveHtml($this->INV_No->caption());

			// PO_InputDate
			// PO_InputUser
			// Add refer script
			// Code

			$this->Code->LinkCustomAttributes = "";
			$this->Code->HrefValue = "";

			// PalletNo
			$this->PalletNo->LinkCustomAttributes = "";
			$this->PalletNo->HrefValue = "";

			// DateIn
			$this->DateIn->LinkCustomAttributes = "";
			$this->DateIn->HrefValue = "";

			// PCS_In
			$this->PCS_In->LinkCustomAttributes = "";
			$this->PCS_In->HrefValue = "";

			// PCS_Out
			$this->PCS_Out->LinkCustomAttributes = "";
			$this->PCS_Out->HrefValue = "";

			// PO_No
			$this->PO_No->LinkCustomAttributes = "";
			$this->PO_No->HrefValue = "";

			// INV_No
			$this->INV_No->LinkCustomAttributes = "";
			$this->INV_No->HrefValue = "";

			// PO_InputDate
			$this->PO_InputDate->LinkCustomAttributes = "";
			$this->PO_InputDate->HrefValue = "";

			// PO_InputUser
			$this->PO_InputUser->LinkCustomAttributes = "";
			$this->PO_InputUser->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// Code
			$this->Code->EditAttrs["class"] = "form-control";
			$this->Code->EditCustomAttributes = "";
			$this->Code->EditValue = $this->Code->CurrentValue;
			$this->Code->ViewCustomAttributes = "";

			// PalletNo
			$this->PalletNo->EditAttrs["class"] = "form-control";
			$this->PalletNo->EditCustomAttributes = "";
			$this->PalletNo->EditValue = $this->PalletNo->CurrentValue;
			$this->PalletNo->CellCssStyle .= "text-align: center;";
			$this->PalletNo->ViewCustomAttributes = "";

			// DateIn
			$this->DateIn->EditAttrs["class"] = "form-control";
			$this->DateIn->EditCustomAttributes = "";
			$this->DateIn->EditValue = $this->DateIn->CurrentValue;
			$this->DateIn->EditValue = FormatDateTime($this->DateIn->EditValue, 7);
			$this->DateIn->CellCssStyle .= "text-align: center;";
			$this->DateIn->ViewCustomAttributes = "";

			// PCS_In
			$this->PCS_In->EditAttrs["class"] = "form-control";
			$this->PCS_In->EditCustomAttributes = "";
			$this->PCS_In->EditValue = $this->PCS_In->CurrentValue;
			$this->PCS_In->EditValue = FormatNumber($this->PCS_In->EditValue, 0, -2, -2, -2);
			$this->PCS_In->CellCssStyle .= "text-align: right;";
			$this->PCS_In->ViewCustomAttributes = "";

			// PCS_Out
			$this->PCS_Out->EditAttrs["class"] = "form-control";
			$this->PCS_Out->EditCustomAttributes = "";
			$this->PCS_Out->EditValue = HtmlEncode($this->PCS_Out->CurrentValue);
			$this->PCS_Out->PlaceHolder = RemoveHtml($this->PCS_Out->caption());

			// PO_No
			$this->PO_No->EditAttrs["class"] = "form-control";
			$this->PO_No->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->PO_No->CurrentValue = HtmlDecode($this->PO_No->CurrentValue);
			$this->PO_No->EditValue = HtmlEncode($this->PO_No->CurrentValue);
			$this->PO_No->PlaceHolder = RemoveHtml($this->PO_No->caption());

			// INV_No
			$this->INV_No->EditAttrs["class"] = "form-control";
			$this->INV_No->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->INV_No->CurrentValue = HtmlDecode($this->INV_No->CurrentValue);
			$this->INV_No->EditValue = HtmlEncode($this->INV_No->CurrentValue);
			$this->INV_No->PlaceHolder = RemoveHtml($this->INV_No->caption());

			// PO_InputDate
			// PO_InputUser
			// Edit refer script
			// Code

			$this->Code->LinkCustomAttributes = "";
			$this->Code->HrefValue = "";
			$this->Code->TooltipValue = "";

			// PalletNo
			$this->PalletNo->LinkCustomAttributes = "";
			$this->PalletNo->HrefValue = "";
			$this->PalletNo->TooltipValue = "";

			// DateIn
			$this->DateIn->LinkCustomAttributes = "";
			$this->DateIn->HrefValue = "";
			$this->DateIn->TooltipValue = "";

			// PCS_In
			$this->PCS_In->LinkCustomAttributes = "";
			$this->PCS_In->HrefValue = "";
			$this->PCS_In->TooltipValue = "";

			// PCS_Out
			$this->PCS_Out->LinkCustomAttributes = "";
			$this->PCS_Out->HrefValue = "";

			// PO_No
			$this->PO_No->LinkCustomAttributes = "";
			$this->PO_No->HrefValue = "";

			// INV_No
			$this->INV_No->LinkCustomAttributes = "";
			$this->INV_No->HrefValue = "";

			// PO_InputDate
			$this->PO_InputDate->LinkCustomAttributes = "";
			$this->PO_InputDate->HrefValue = "";
			$this->PO_InputDate->TooltipValue = "";

			// PO_InputUser
			$this->PO_InputUser->LinkCustomAttributes = "";
			$this->PO_InputUser->HrefValue = "";
			$this->PO_InputUser->TooltipValue = "";
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
		if ($this->ID_PoInv->Required) {
			if (!$this->ID_PoInv->IsDetailKey && $this->ID_PoInv->FormValue != NULL && $this->ID_PoInv->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_PoInv->caption(), $this->ID_PoInv->RequiredErrorMessage));
			}
		}
		if ($this->OrderNo->Required) {
			if (!$this->OrderNo->IsDetailKey && $this->OrderNo->FormValue != NULL && $this->OrderNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OrderNo->caption(), $this->OrderNo->RequiredErrorMessage));
			}
		}
		if ($this->Code->Required) {
			if (!$this->Code->IsDetailKey && $this->Code->FormValue != NULL && $this->Code->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Code->caption(), $this->Code->RequiredErrorMessage));
			}
		}
		if ($this->PalletNo->Required) {
			if (!$this->PalletNo->IsDetailKey && $this->PalletNo->FormValue != NULL && $this->PalletNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PalletNo->caption(), $this->PalletNo->RequiredErrorMessage));
			}
		}
		if ($this->DateIn->Required) {
			if (!$this->DateIn->IsDetailKey && $this->DateIn->FormValue != NULL && $this->DateIn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateIn->caption(), $this->DateIn->RequiredErrorMessage));
			}
		}
		if ($this->PCS_In->Required) {
			if (!$this->PCS_In->IsDetailKey && $this->PCS_In->FormValue != NULL && $this->PCS_In->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PCS_In->caption(), $this->PCS_In->RequiredErrorMessage));
			}
		}
		if ($this->PCS_Out->Required) {
			if (!$this->PCS_Out->IsDetailKey && $this->PCS_Out->FormValue != NULL && $this->PCS_Out->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PCS_Out->caption(), $this->PCS_Out->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PCS_Out->FormValue)) {
			AddMessage($FormError, $this->PCS_Out->errorMessage());
		}
		if ($this->PO_No->Required) {
			if (!$this->PO_No->IsDetailKey && $this->PO_No->FormValue != NULL && $this->PO_No->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PO_No->caption(), $this->PO_No->RequiredErrorMessage));
			}
		}
		if ($this->INV_No->Required) {
			if (!$this->INV_No->IsDetailKey && $this->INV_No->FormValue != NULL && $this->INV_No->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->INV_No->caption(), $this->INV_No->RequiredErrorMessage));
			}
		}
		if ($this->PO_InputDate->Required) {
			if (!$this->PO_InputDate->IsDetailKey && $this->PO_InputDate->FormValue != NULL && $this->PO_InputDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PO_InputDate->caption(), $this->PO_InputDate->RequiredErrorMessage));
			}
		}
		if ($this->PO_InputUser->Required) {
			if (!$this->PO_InputUser->IsDetailKey && $this->PO_InputUser->FormValue != NULL && $this->PO_InputUser->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PO_InputUser->caption(), $this->PO_InputUser->RequiredErrorMessage));
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
				$thisKey .= $row['ID_PoInv'];
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

			// PCS_Out
			$this->PCS_Out->setDbValueDef($rsnew, $this->PCS_Out->CurrentValue, NULL, $this->PCS_Out->ReadOnly);

			// PO_No
			$this->PO_No->setDbValueDef($rsnew, $this->PO_No->CurrentValue, NULL, $this->PO_No->ReadOnly);

			// INV_No
			$this->INV_No->setDbValueDef($rsnew, $this->INV_No->CurrentValue, NULL, $this->INV_No->ReadOnly);

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
				$this->OrderNo->CurrentValue = $this->OrderNo->getSessionValue();
			}
		$conn = &$this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// Code
		$this->Code->setDbValueDef($rsnew, $this->Code->CurrentValue, NULL, FALSE);

		// PalletNo
		$this->PalletNo->setDbValueDef($rsnew, $this->PalletNo->CurrentValue, NULL, FALSE);

		// DateIn
		$this->DateIn->setDbValueDef($rsnew, UnFormatDateTime($this->DateIn->CurrentValue, 7), NULL, FALSE);

		// PCS_In
		$this->PCS_In->setDbValueDef($rsnew, $this->PCS_In->CurrentValue, NULL, FALSE);

		// PCS_Out
		$this->PCS_Out->setDbValueDef($rsnew, $this->PCS_Out->CurrentValue, NULL, FALSE);

		// PO_No
		$this->PO_No->setDbValueDef($rsnew, $this->PO_No->CurrentValue, NULL, FALSE);

		// INV_No
		$this->INV_No->setDbValueDef($rsnew, $this->INV_No->CurrentValue, NULL, FALSE);

		// PO_InputDate
		$this->PO_InputDate->setDbValueDef($rsnew, CurrentDateTime(), NULL);
		$rsnew['PO_InputDate'] = &$this->PO_InputDate->DbValue;

		// PO_InputUser
		$this->PO_InputUser->setDbValueDef($rsnew, CurrentUserName(), NULL);
		$rsnew['PO_InputUser'] = &$this->PO_InputUser->DbValue;

		// OrderNo
		if ($this->OrderNo->getSessionValue() <> "") {
			$rsnew['OrderNo'] = $this->OrderNo->getSessionValue();
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
			$this->OrderNo->Visible = FALSE;
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