<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Page class
 */
class tbl_unload_add extends tbl_unload
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{004E2122-9CCA-46AA-835C-0778C5A080BC}";

	// Table name
	public $TableName = 'tbl_unload';

	// Page object name
	public $PageObjName = "tbl_unload_add";

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

		// Table object (tbl_unload)
		if (!isset($GLOBALS["tbl_unload"]) || get_class($GLOBALS["tbl_unload"]) == PROJECT_NAMESPACE . "tbl_unload") {
			$GLOBALS["tbl_unload"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_unload"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (tbl_route)
		if (!isset($GLOBALS['tbl_route']))
			$GLOBALS['tbl_route'] = new tbl_route();

		// Table object (tbl_user)
		if (!isset($GLOBALS['tbl_user']))
			$GLOBALS['tbl_user'] = new tbl_user();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_unload');

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
		global $EXPORT, $tbl_unload;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_unload);
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
					if ($pageName == "tbl_unloadview.php")
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
			$key .= @$ar['ID_Unload'];
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
			$this->ID_Unload->Visible = FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRec;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("tbl_unloadlist.php"));
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
		$this->ID_Unload->Visible = FALSE;
		$this->ID_Route->Visible = FALSE;
		$this->Code->setVisibility();
		$this->IdCode->Visible = FALSE;
		$this->PCS->setVisibility();
		$this->RealPCS->setVisibility();
		$this->Description->setVisibility();
		$this->CreateUser->setVisibility();
		$this->CreateDate->setVisibility();
		$this->UserUnload->Visible = FALSE;
		$this->DateTime_Insert->Visible = FALSE;
		$this->UpdateUser->Visible = FALSE;
		$this->UpdateDate->Visible = FALSE;
		$this->MFG->setVisibility();
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
		$this->setupLookupOptions($this->Code);
		$this->setupLookupOptions($this->IdCode);
		$this->setupLookupOptions($this->UserUnload);

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("ID_Unload") !== NULL) {
				$this->ID_Unload->setQueryStringValue(Get("ID_Unload"));
				$this->setKey("ID_Unload", $this->ID_Unload->CurrentValue); // Set up key
			} else {
				$this->setKey("ID_Unload", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Set up master/detail parameters
		// NOTE: must be after loadOldRecord to prevent master key values overwritten

		$this->setupMasterParms();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("tbl_unloadlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "tbl_unloadlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "tbl_unloadview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->ID_Unload->CurrentValue = NULL;
		$this->ID_Unload->OldValue = $this->ID_Unload->CurrentValue;
		$this->ID_Route->CurrentValue = NULL;
		$this->ID_Route->OldValue = $this->ID_Route->CurrentValue;
		$this->Code->CurrentValue = NULL;
		$this->Code->OldValue = $this->Code->CurrentValue;
		$this->IdCode->CurrentValue = NULL;
		$this->IdCode->OldValue = $this->IdCode->CurrentValue;
		$this->PCS->CurrentValue = NULL;
		$this->PCS->OldValue = $this->PCS->CurrentValue;
		$this->RealPCS->CurrentValue = NULL;
		$this->RealPCS->OldValue = $this->RealPCS->CurrentValue;
		$this->Description->CurrentValue = NULL;
		$this->Description->OldValue = $this->Description->CurrentValue;
		$this->CreateUser->CurrentValue = NULL;
		$this->CreateUser->OldValue = $this->CreateUser->CurrentValue;
		$this->CreateDate->CurrentValue = NULL;
		$this->CreateDate->OldValue = $this->CreateDate->CurrentValue;
		$this->UserUnload->CurrentValue = NULL;
		$this->UserUnload->OldValue = $this->UserUnload->CurrentValue;
		$this->DateTime_Insert->CurrentValue = NULL;
		$this->DateTime_Insert->OldValue = $this->DateTime_Insert->CurrentValue;
		$this->UpdateUser->CurrentValue = NULL;
		$this->UpdateUser->OldValue = $this->UpdateUser->CurrentValue;
		$this->UpdateDate->CurrentValue = NULL;
		$this->UpdateDate->OldValue = $this->UpdateDate->CurrentValue;
		$this->MFG->CurrentValue = NULL;
		$this->MFG->OldValue = $this->MFG->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'Code' first before field var 'x_Code'
		$val = $CurrentForm->hasValue("Code") ? $CurrentForm->getValue("Code") : $CurrentForm->getValue("x_Code");
		if (!$this->Code->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Code->Visible = FALSE; // Disable update for API request
			else
				$this->Code->setFormValue($val);
		}

		// Check field name 'PCS' first before field var 'x_PCS'
		$val = $CurrentForm->hasValue("PCS") ? $CurrentForm->getValue("PCS") : $CurrentForm->getValue("x_PCS");
		if (!$this->PCS->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PCS->Visible = FALSE; // Disable update for API request
			else
				$this->PCS->setFormValue($val);
		}

		// Check field name 'RealPCS' first before field var 'x_RealPCS'
		$val = $CurrentForm->hasValue("RealPCS") ? $CurrentForm->getValue("RealPCS") : $CurrentForm->getValue("x_RealPCS");
		if (!$this->RealPCS->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->RealPCS->Visible = FALSE; // Disable update for API request
			else
				$this->RealPCS->setFormValue($val);
		}

		// Check field name 'Description' first before field var 'x_Description'
		$val = $CurrentForm->hasValue("Description") ? $CurrentForm->getValue("Description") : $CurrentForm->getValue("x_Description");
		if (!$this->Description->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Description->Visible = FALSE; // Disable update for API request
			else
				$this->Description->setFormValue($val);
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
			$this->CreateDate->CurrentValue = UnFormatDateTime($this->CreateDate->CurrentValue, 0);
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

		// Check field name 'ID_Unload' first before field var 'x_ID_Unload'
		$val = $CurrentForm->hasValue("ID_Unload") ? $CurrentForm->getValue("ID_Unload") : $CurrentForm->getValue("x_ID_Unload");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->Code->CurrentValue = $this->Code->FormValue;
		$this->PCS->CurrentValue = $this->PCS->FormValue;
		$this->RealPCS->CurrentValue = $this->RealPCS->FormValue;
		$this->Description->CurrentValue = $this->Description->FormValue;
		$this->CreateUser->CurrentValue = $this->CreateUser->FormValue;
		$this->CreateDate->CurrentValue = $this->CreateDate->FormValue;
		$this->CreateDate->CurrentValue = UnFormatDateTime($this->CreateDate->CurrentValue, 0);
		$this->MFG->CurrentValue = $this->MFG->FormValue;
		$this->MFG->CurrentValue = UnFormatDateTime($this->MFG->CurrentValue, 7);
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
		$this->ID_Unload->setDbValue($row['ID_Unload']);
		$this->ID_Route->setDbValue($row['ID_Route']);
		$this->Code->setDbValue($row['Code']);
		if (array_key_exists('EV__Code', $rs->fields)) {
			$this->Code->VirtualValue = $rs->fields('EV__Code'); // Set up virtual field value
		} else {
			$this->Code->VirtualValue = ""; // Clear value
		}
		$this->IdCode->setDbValue($row['IdCode']);
		$this->PCS->setDbValue($row['PCS']);
		$this->RealPCS->setDbValue($row['RealPCS']);
		$this->Description->setDbValue($row['Description']);
		$this->CreateUser->setDbValue($row['CreateUser']);
		$this->CreateDate->setDbValue($row['CreateDate']);
		$this->UserUnload->setDbValue($row['UserUnload']);
		if (array_key_exists('EV__UserUnload', $rs->fields)) {
			$this->UserUnload->VirtualValue = $rs->fields('EV__UserUnload'); // Set up virtual field value
		} else {
			$this->UserUnload->VirtualValue = ""; // Clear value
		}
		$this->DateTime_Insert->setDbValue($row['DateTime_Insert']);
		$this->UpdateUser->setDbValue($row['UpdateUser']);
		$this->UpdateDate->setDbValue($row['UpdateDate']);
		$this->MFG->setDbValue($row['MFG']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ID_Unload'] = $this->ID_Unload->CurrentValue;
		$row['ID_Route'] = $this->ID_Route->CurrentValue;
		$row['Code'] = $this->Code->CurrentValue;
		$row['IdCode'] = $this->IdCode->CurrentValue;
		$row['PCS'] = $this->PCS->CurrentValue;
		$row['RealPCS'] = $this->RealPCS->CurrentValue;
		$row['Description'] = $this->Description->CurrentValue;
		$row['CreateUser'] = $this->CreateUser->CurrentValue;
		$row['CreateDate'] = $this->CreateDate->CurrentValue;
		$row['UserUnload'] = $this->UserUnload->CurrentValue;
		$row['DateTime_Insert'] = $this->DateTime_Insert->CurrentValue;
		$row['UpdateUser'] = $this->UpdateUser->CurrentValue;
		$row['UpdateDate'] = $this->UpdateDate->CurrentValue;
		$row['MFG'] = $this->MFG->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ID_Unload")) <> "")
			$this->ID_Unload->CurrentValue = $this->getKey("ID_Unload"); // ID_Unload
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
		// ID_Unload
		// ID_Route
		// Code
		// IdCode
		// PCS
		// RealPCS
		// Description
		// CreateUser
		// CreateDate
		// UserUnload
		// DateTime_Insert
		// UpdateUser
		// UpdateDate
		// MFG

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// Code
			if ($this->Code->VirtualValue <> "") {
				$this->Code->ViewValue = $this->Code->VirtualValue;
			} else {
				$this->Code->ViewValue = $this->Code->CurrentValue;
			$curVal = strval($this->Code->CurrentValue);
			if ($curVal <> "") {
				$this->Code->ViewValue = $this->Code->lookupCacheOption($curVal);
				if ($this->Code->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Code`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Code->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->Code->ViewValue = $this->Code->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Code->ViewValue = $this->Code->CurrentValue;
					}
				}
			} else {
				$this->Code->ViewValue = NULL;
			}
			}
			$this->Code->ViewCustomAttributes = "";

			// IdCode
			$this->IdCode->ViewValue = $this->IdCode->CurrentValue;
			$curVal = strval($this->IdCode->CurrentValue);
			if ($curVal <> "") {
				$this->IdCode->ViewValue = $this->IdCode->lookupCacheOption($curVal);
				if ($this->IdCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`IdCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->IdCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
						$this->IdCode->ViewValue = $this->IdCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->IdCode->ViewValue = $this->IdCode->CurrentValue;
					}
				}
			} else {
				$this->IdCode->ViewValue = NULL;
			}
			$this->IdCode->CellCssStyle .= "text-align: center;";
			$this->IdCode->ViewCustomAttributes = "";

			// PCS
			$this->PCS->ViewValue = $this->PCS->CurrentValue;
			$this->PCS->ViewValue = FormatNumber($this->PCS->ViewValue, 0, -2, -2, -2);
			$this->PCS->CellCssStyle .= "text-align: right;";
			$this->PCS->ViewCustomAttributes = "";

			// RealPCS
			$this->RealPCS->ViewValue = $this->RealPCS->CurrentValue;
			$this->RealPCS->ViewValue = FormatNumber($this->RealPCS->ViewValue, 0, -2, -2, -2);
			$this->RealPCS->CellCssStyle .= "text-align: right;";
			$this->RealPCS->ViewCustomAttributes = "";

			// Description
			$this->Description->ViewValue = $this->Description->CurrentValue;
			$this->Description->ViewCustomAttributes = "";

			// CreateUser
			$this->CreateUser->ViewValue = $this->CreateUser->CurrentValue;
			$this->CreateUser->ViewCustomAttributes = "";

			// CreateDate
			$this->CreateDate->ViewValue = $this->CreateDate->CurrentValue;
			$this->CreateDate->ViewValue = FormatDateTime($this->CreateDate->ViewValue, 0);
			$this->CreateDate->ViewCustomAttributes = "";

			// MFG
			$this->MFG->ViewValue = $this->MFG->CurrentValue;
			$this->MFG->ViewValue = FormatDateTime($this->MFG->ViewValue, 7);
			$this->MFG->CellCssStyle .= "text-align: center;";
			$this->MFG->ViewCustomAttributes = "";

			// Code
			$this->Code->LinkCustomAttributes = "";
			$this->Code->HrefValue = "";
			$this->Code->TooltipValue = "";

			// PCS
			$this->PCS->LinkCustomAttributes = "";
			$this->PCS->HrefValue = "";
			$this->PCS->TooltipValue = "";

			// RealPCS
			$this->RealPCS->LinkCustomAttributes = "";
			$this->RealPCS->HrefValue = "";
			$this->RealPCS->TooltipValue = "";

			// Description
			$this->Description->LinkCustomAttributes = "";
			$this->Description->HrefValue = "";
			$this->Description->TooltipValue = "";

			// CreateUser
			$this->CreateUser->LinkCustomAttributes = "";
			$this->CreateUser->HrefValue = "";
			$this->CreateUser->TooltipValue = "";

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";
			$this->CreateDate->TooltipValue = "";

			// MFG
			$this->MFG->LinkCustomAttributes = "";
			$this->MFG->HrefValue = "";
			$this->MFG->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// Code
			$this->Code->EditAttrs["class"] = "form-control";
			$this->Code->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Code->CurrentValue = HtmlDecode($this->Code->CurrentValue);
			$this->Code->EditValue = HtmlEncode($this->Code->CurrentValue);
			$curVal = strval($this->Code->CurrentValue);
			if ($curVal <> "") {
				$this->Code->EditValue = $this->Code->lookupCacheOption($curVal);
				if ($this->Code->EditValue === NULL) { // Lookup from database
					$filterWrk = "`Code`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Code->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->Code->EditValue = $this->Code->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Code->EditValue = HtmlEncode($this->Code->CurrentValue);
					}
				}
			} else {
				$this->Code->EditValue = NULL;
			}
			$this->Code->PlaceHolder = RemoveHtml($this->Code->caption());

			// PCS
			$this->PCS->EditAttrs["class"] = "form-control";
			$this->PCS->EditCustomAttributes = "";
			$this->PCS->EditValue = HtmlEncode($this->PCS->CurrentValue);
			$this->PCS->PlaceHolder = RemoveHtml($this->PCS->caption());

			// RealPCS
			$this->RealPCS->EditAttrs["class"] = "form-control";
			$this->RealPCS->EditCustomAttributes = "";
			$this->RealPCS->EditValue = HtmlEncode($this->RealPCS->CurrentValue);
			$this->RealPCS->PlaceHolder = RemoveHtml($this->RealPCS->caption());

			// Description
			$this->Description->EditAttrs["class"] = "form-control";
			$this->Description->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Description->CurrentValue = HtmlDecode($this->Description->CurrentValue);
			$this->Description->EditValue = HtmlEncode($this->Description->CurrentValue);
			$this->Description->PlaceHolder = RemoveHtml($this->Description->caption());

			// CreateUser
			// CreateDate
			// MFG

			$this->MFG->EditAttrs["class"] = "form-control";
			$this->MFG->EditCustomAttributes = "";
			$this->MFG->EditValue = HtmlEncode(FormatDateTime($this->MFG->CurrentValue, 7));
			$this->MFG->PlaceHolder = RemoveHtml($this->MFG->caption());

			// Add refer script
			// Code

			$this->Code->LinkCustomAttributes = "";
			$this->Code->HrefValue = "";

			// PCS
			$this->PCS->LinkCustomAttributes = "";
			$this->PCS->HrefValue = "";

			// RealPCS
			$this->RealPCS->LinkCustomAttributes = "";
			$this->RealPCS->HrefValue = "";

			// Description
			$this->Description->LinkCustomAttributes = "";
			$this->Description->HrefValue = "";

			// CreateUser
			$this->CreateUser->LinkCustomAttributes = "";
			$this->CreateUser->HrefValue = "";

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";

			// MFG
			$this->MFG->LinkCustomAttributes = "";
			$this->MFG->HrefValue = "";
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
		if ($this->ID_Unload->Required) {
			if (!$this->ID_Unload->IsDetailKey && $this->ID_Unload->FormValue != NULL && $this->ID_Unload->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Unload->caption(), $this->ID_Unload->RequiredErrorMessage));
			}
		}
		if ($this->ID_Route->Required) {
			if (!$this->ID_Route->IsDetailKey && $this->ID_Route->FormValue != NULL && $this->ID_Route->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Route->caption(), $this->ID_Route->RequiredErrorMessage));
			}
		}
		if ($this->Code->Required) {
			if (!$this->Code->IsDetailKey && $this->Code->FormValue != NULL && $this->Code->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Code->caption(), $this->Code->RequiredErrorMessage));
			}
		}
		if ($this->IdCode->Required) {
			if (!$this->IdCode->IsDetailKey && $this->IdCode->FormValue != NULL && $this->IdCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IdCode->caption(), $this->IdCode->RequiredErrorMessage));
			}
		}
		if ($this->PCS->Required) {
			if (!$this->PCS->IsDetailKey && $this->PCS->FormValue != NULL && $this->PCS->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PCS->caption(), $this->PCS->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PCS->FormValue)) {
			AddMessage($FormError, $this->PCS->errorMessage());
		}
		if ($this->RealPCS->Required) {
			if (!$this->RealPCS->IsDetailKey && $this->RealPCS->FormValue != NULL && $this->RealPCS->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RealPCS->caption(), $this->RealPCS->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->RealPCS->FormValue)) {
			AddMessage($FormError, $this->RealPCS->errorMessage());
		}
		if ($this->Description->Required) {
			if (!$this->Description->IsDetailKey && $this->Description->FormValue != NULL && $this->Description->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Description->caption(), $this->Description->RequiredErrorMessage));
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
		if ($this->UserUnload->Required) {
			if (!$this->UserUnload->IsDetailKey && $this->UserUnload->FormValue != NULL && $this->UserUnload->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UserUnload->caption(), $this->UserUnload->RequiredErrorMessage));
			}
		}
		if ($this->DateTime_Insert->Required) {
			if (!$this->DateTime_Insert->IsDetailKey && $this->DateTime_Insert->FormValue != NULL && $this->DateTime_Insert->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateTime_Insert->caption(), $this->DateTime_Insert->RequiredErrorMessage));
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
		if ($this->MFG->Required) {
			if (!$this->MFG->IsDetailKey && $this->MFG->FormValue != NULL && $this->MFG->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MFG->caption(), $this->MFG->RequiredErrorMessage));
			}
		}
		if (!CheckEuroDate($this->MFG->FormValue)) {
			AddMessage($FormError, $this->MFG->errorMessage());
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

		// Code
		$this->Code->setDbValueDef($rsnew, $this->Code->CurrentValue, "", FALSE);

		// PCS
		$this->PCS->setDbValueDef($rsnew, $this->PCS->CurrentValue, 0, FALSE);

		// RealPCS
		$this->RealPCS->setDbValueDef($rsnew, $this->RealPCS->CurrentValue, 0, FALSE);

		// Description
		$this->Description->setDbValueDef($rsnew, $this->Description->CurrentValue, NULL, FALSE);

		// CreateUser
		$this->CreateUser->setDbValueDef($rsnew, CurrentUserName(), NULL);
		$rsnew['CreateUser'] = &$this->CreateUser->DbValue;

		// CreateDate
		$this->CreateDate->setDbValueDef($rsnew, CurrentDateTime(), NULL);
		$rsnew['CreateDate'] = &$this->CreateDate->DbValue;

		// MFG
		$this->MFG->setDbValueDef($rsnew, UnFormatDateTime($this->MFG->CurrentValue, 7), NULL, FALSE);

		// ID_Route
		if ($this->ID_Route->getSessionValue() <> "") {
			$rsnew['ID_Route'] = $this->ID_Route->getSessionValue();
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
		$validMaster = FALSE;

		// Get the keys for master table
		if (Get(TABLE_SHOW_MASTER) !== NULL) {
			$masterTblVar = Get(TABLE_SHOW_MASTER);
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "tbl_route") {
				$validMaster = TRUE;
				if (Get("fk_ID_Route") !== NULL) {
					$this->ID_Route->setQueryStringValue(Get("fk_ID_Route"));
					$this->ID_Route->setSessionValue($this->ID_Route->QueryStringValue);
					if (!is_numeric($this->ID_Route->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (Post(TABLE_SHOW_MASTER) !== NULL) {
			$masterTblVar = Post(TABLE_SHOW_MASTER);
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "tbl_route") {
				$validMaster = TRUE;
				if (Post("fk_ID_Route") !== NULL) {
					$this->ID_Route->setFormValue(Post("fk_ID_Route"));
					$this->ID_Route->setSessionValue($this->ID_Route->FormValue);
					if (!is_numeric($this->ID_Route->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRec = 1;
				$this->setStartRecordNumber($this->StartRec);
			}

			// Clear previous master key from Session
			if ($masterTblVar <> "tbl_route") {
				if ($this->ID_Route->CurrentValue == "")
					$this->ID_Route->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tbl_unloadlist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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
						case "x_Code":
							break;
						case "x_IdCode":
							$row[1] = FormatNumber($row[1], 0, -2, -2, -2);
							$row['df'] = $row[1];
							break;
						case "x_UserUnload":
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