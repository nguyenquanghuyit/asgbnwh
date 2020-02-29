<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Page class
 */
class tbl_order_po_inv_edit extends tbl_order_po_inv
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{004E2122-9CCA-46AA-835C-0778C5A080BC}";

	// Table name
	public $TableName = 'tbl_order_po_inv';

	// Page object name
	public $PageObjName = "tbl_order_po_inv_edit";

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

		// Table object (tbl_order_po_inv)
		if (!isset($GLOBALS["tbl_order_po_inv"]) || get_class($GLOBALS["tbl_order_po_inv"]) == PROJECT_NAMESPACE . "tbl_order_po_inv") {
			$GLOBALS["tbl_order_po_inv"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_order_po_inv"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (tbl_user)
		if (!isset($GLOBALS['tbl_user']))
			$GLOBALS['tbl_user'] = new tbl_user();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

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
					if ($pageName == "tbl_order_po_invview.php")
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
	}
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SkipHeaderFooter;

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
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("tbl_order_po_invlist.php"));
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
		$this->ID_PoInv->Visible = FALSE;
		$this->OrderNo->setVisibility();
		$this->Code->setVisibility();
		$this->PalletNo->setVisibility();
		$this->DateIn->setVisibility();
		$this->PCS_In->setVisibility();
		$this->PCS_Out->setVisibility();
		$this->PO_No->setVisibility();
		$this->INV_No->setVisibility();
		$this->PO_InputDate->Visible = FALSE;
		$this->PO_InputUser->Visible = FALSE;
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
		// Check modal

		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get action code
			if (!$this->isShow()) // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($CurrentForm->hasValue("x_ID_PoInv")) {
				$this->ID_PoInv->setFormValue($CurrentForm->getValue("x_ID_PoInv"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("ID_PoInv") !== NULL) {
				$this->ID_PoInv->setQueryStringValue(Get("ID_PoInv"));
				$loadByQuery = TRUE;
			} else {
				$this->ID_PoInv->CurrentValue = NULL;
			}
		}

		// Load current record
		$loaded = $this->loadRow();

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("tbl_order_po_invlist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "tbl_order_po_invlist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
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

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'OrderNo' first before field var 'x_OrderNo'
		$val = $CurrentForm->hasValue("OrderNo") ? $CurrentForm->getValue("OrderNo") : $CurrentForm->getValue("x_OrderNo");
		if (!$this->OrderNo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->OrderNo->Visible = FALSE; // Disable update for API request
			else
				$this->OrderNo->setFormValue($val);
		}

		// Check field name 'Code' first before field var 'x_Code'
		$val = $CurrentForm->hasValue("Code") ? $CurrentForm->getValue("Code") : $CurrentForm->getValue("x_Code");
		if (!$this->Code->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Code->Visible = FALSE; // Disable update for API request
			else
				$this->Code->setFormValue($val);
		}

		// Check field name 'PalletNo' first before field var 'x_PalletNo'
		$val = $CurrentForm->hasValue("PalletNo") ? $CurrentForm->getValue("PalletNo") : $CurrentForm->getValue("x_PalletNo");
		if (!$this->PalletNo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PalletNo->Visible = FALSE; // Disable update for API request
			else
				$this->PalletNo->setFormValue($val);
		}

		// Check field name 'DateIn' first before field var 'x_DateIn'
		$val = $CurrentForm->hasValue("DateIn") ? $CurrentForm->getValue("DateIn") : $CurrentForm->getValue("x_DateIn");
		if (!$this->DateIn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DateIn->Visible = FALSE; // Disable update for API request
			else
				$this->DateIn->setFormValue($val);
			$this->DateIn->CurrentValue = UnFormatDateTime($this->DateIn->CurrentValue, 7);
		}

		// Check field name 'PCS_In' first before field var 'x_PCS_In'
		$val = $CurrentForm->hasValue("PCS_In") ? $CurrentForm->getValue("PCS_In") : $CurrentForm->getValue("x_PCS_In");
		if (!$this->PCS_In->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PCS_In->Visible = FALSE; // Disable update for API request
			else
				$this->PCS_In->setFormValue($val);
		}

		// Check field name 'PCS_Out' first before field var 'x_PCS_Out'
		$val = $CurrentForm->hasValue("PCS_Out") ? $CurrentForm->getValue("PCS_Out") : $CurrentForm->getValue("x_PCS_Out");
		if (!$this->PCS_Out->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PCS_Out->Visible = FALSE; // Disable update for API request
			else
				$this->PCS_Out->setFormValue($val);
		}

		// Check field name 'PO_No' first before field var 'x_PO_No'
		$val = $CurrentForm->hasValue("PO_No") ? $CurrentForm->getValue("PO_No") : $CurrentForm->getValue("x_PO_No");
		if (!$this->PO_No->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PO_No->Visible = FALSE; // Disable update for API request
			else
				$this->PO_No->setFormValue($val);
		}

		// Check field name 'INV_No' first before field var 'x_INV_No'
		$val = $CurrentForm->hasValue("INV_No") ? $CurrentForm->getValue("INV_No") : $CurrentForm->getValue("x_INV_No");
		if (!$this->INV_No->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->INV_No->Visible = FALSE; // Disable update for API request
			else
				$this->INV_No->setFormValue($val);
		}

		// Check field name 'ID_PoInv' first before field var 'x_ID_PoInv'
		$val = $CurrentForm->hasValue("ID_PoInv") ? $CurrentForm->getValue("ID_PoInv") : $CurrentForm->getValue("x_ID_PoInv");
		if (!$this->ID_PoInv->IsDetailKey)
			$this->ID_PoInv->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ID_PoInv->CurrentValue = $this->ID_PoInv->FormValue;
		$this->OrderNo->CurrentValue = $this->OrderNo->FormValue;
		$this->Code->CurrentValue = $this->Code->FormValue;
		$this->PalletNo->CurrentValue = $this->PalletNo->FormValue;
		$this->DateIn->CurrentValue = $this->DateIn->FormValue;
		$this->DateIn->CurrentValue = UnFormatDateTime($this->DateIn->CurrentValue, 7);
		$this->PCS_In->CurrentValue = $this->PCS_In->FormValue;
		$this->PCS_Out->CurrentValue = $this->PCS_Out->FormValue;
		$this->PO_No->CurrentValue = $this->PO_No->FormValue;
		$this->INV_No->CurrentValue = $this->INV_No->FormValue;
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
		$row = [];
		$row['ID_PoInv'] = NULL;
		$row['OrderNo'] = NULL;
		$row['Code'] = NULL;
		$row['PalletNo'] = NULL;
		$row['DateIn'] = NULL;
		$row['PCS_In'] = NULL;
		$row['PCS_Out'] = NULL;
		$row['PO_No'] = NULL;
		$row['INV_No'] = NULL;
		$row['PO_InputDate'] = NULL;
		$row['PO_InputUser'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ID_PoInv")) <> "")
			$this->ID_PoInv->CurrentValue = $this->getKey("ID_PoInv"); // ID_PoInv
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// ID_PoInv
		// OrderNo
		// Code
		// PalletNo
		// DateIn
		// PCS_In
		// PCS_Out
		// PO_No
		// INV_No
		// PO_InputDate
		// PO_InputUser

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// OrderNo
			$this->OrderNo->ViewValue = $this->OrderNo->CurrentValue;
			$this->OrderNo->ViewValue = FormatNumber($this->OrderNo->ViewValue, 0, -2, -2, -2);
			$this->OrderNo->CellCssStyle .= "text-align: center;";
			$this->OrderNo->ViewCustomAttributes = "";

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

			// OrderNo
			$this->OrderNo->LinkCustomAttributes = "";
			$this->OrderNo->HrefValue = "";
			$this->OrderNo->TooltipValue = "";

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
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// OrderNo
			$this->OrderNo->EditAttrs["class"] = "form-control";
			$this->OrderNo->EditCustomAttributes = "";
			$this->OrderNo->EditValue = $this->OrderNo->CurrentValue;
			$this->OrderNo->EditValue = FormatNumber($this->OrderNo->EditValue, 0, -2, -2, -2);
			$this->OrderNo->CellCssStyle .= "text-align: center;";
			$this->OrderNo->ViewCustomAttributes = "";

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

			// Edit refer script
			// OrderNo

			$this->OrderNo->LinkCustomAttributes = "";
			$this->OrderNo->HrefValue = "";
			$this->OrderNo->TooltipValue = "";

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

		// Initialize form error message
		$FormError = "";

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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tbl_order_po_invlist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
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
}
?>