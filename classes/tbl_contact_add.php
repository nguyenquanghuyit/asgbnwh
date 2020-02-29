<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Page class
 */
class tbl_contact_add extends tbl_contact
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{004E2122-9CCA-46AA-835C-0778C5A080BC}";

	// Table name
	public $TableName = 'tbl_contact';

	// Page object name
	public $PageObjName = "tbl_contact_add";

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

		// Table object (tbl_contact)
		if (!isset($GLOBALS["tbl_contact"]) || get_class($GLOBALS["tbl_contact"]) == PROJECT_NAMESPACE . "tbl_contact") {
			$GLOBALS["tbl_contact"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_contact"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (tbl_user)
		if (!isset($GLOBALS['tbl_user']))
			$GLOBALS['tbl_user'] = new tbl_user();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_contact');

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
		global $EXPORT, $tbl_contact;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_contact);
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
					if ($pageName == "tbl_contactview.php")
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
			$key .= @$ar['ID_Contact'];
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
			$this->ID_Contact->Visible = FALSE;
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
					$this->terminate(GetUrl("tbl_contactlist.php"));
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
		$this->ID_Contact->Visible = FALSE;
		$this->CodeContact->setVisibility();
		$this->ContactType->setVisibility();
		$this->ContactName->setVisibility();
		$this->CompanyName->setVisibility();
		$this->Address->setVisibility();
		$this->ContactPhone->setVisibility();
		$this->ContactEmail->setVisibility();
		$this->ReceiveName->setVisibility();
		$this->ReceiveTime->setVisibility();
		$this->Note->setVisibility();
		$this->CreateUser->setVisibility();
		$this->CreateDate->setVisibility();
		$this->UpdateUser->Visible = FALSE;
		$this->UpdateDate->Visible = FALSE;
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
			if (Get("ID_Contact") !== NULL) {
				$this->ID_Contact->setQueryStringValue(Get("ID_Contact"));
				$this->setKey("ID_Contact", $this->ID_Contact->CurrentValue); // Set up key
			} else {
				$this->setKey("ID_Contact", ""); // Clear key
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
					$this->terminate("tbl_contactlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "tbl_contactlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "tbl_contactview.php")
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
		$this->ID_Contact->CurrentValue = NULL;
		$this->ID_Contact->OldValue = $this->ID_Contact->CurrentValue;
		$this->CodeContact->CurrentValue = NULL;
		$this->CodeContact->OldValue = $this->CodeContact->CurrentValue;
		$this->ContactType->CurrentValue = NULL;
		$this->ContactType->OldValue = $this->ContactType->CurrentValue;
		$this->ContactName->CurrentValue = NULL;
		$this->ContactName->OldValue = $this->ContactName->CurrentValue;
		$this->CompanyName->CurrentValue = NULL;
		$this->CompanyName->OldValue = $this->CompanyName->CurrentValue;
		$this->Address->CurrentValue = NULL;
		$this->Address->OldValue = $this->Address->CurrentValue;
		$this->ContactPhone->CurrentValue = NULL;
		$this->ContactPhone->OldValue = $this->ContactPhone->CurrentValue;
		$this->ContactEmail->CurrentValue = NULL;
		$this->ContactEmail->OldValue = $this->ContactEmail->CurrentValue;
		$this->ReceiveName->CurrentValue = NULL;
		$this->ReceiveName->OldValue = $this->ReceiveName->CurrentValue;
		$this->ReceiveTime->CurrentValue = NULL;
		$this->ReceiveTime->OldValue = $this->ReceiveTime->CurrentValue;
		$this->Note->CurrentValue = NULL;
		$this->Note->OldValue = $this->Note->CurrentValue;
		$this->CreateUser->CurrentValue = CurrentUserName();
		$this->CreateDate->CurrentValue = CurrentDateTime();
		$this->UpdateUser->CurrentValue = NULL;
		$this->UpdateUser->OldValue = $this->UpdateUser->CurrentValue;
		$this->UpdateDate->CurrentValue = NULL;
		$this->UpdateDate->OldValue = $this->UpdateDate->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'CodeContact' first before field var 'x_CodeContact'
		$val = $CurrentForm->hasValue("CodeContact") ? $CurrentForm->getValue("CodeContact") : $CurrentForm->getValue("x_CodeContact");
		if (!$this->CodeContact->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CodeContact->Visible = FALSE; // Disable update for API request
			else
				$this->CodeContact->setFormValue($val);
		}

		// Check field name 'ContactType' first before field var 'x_ContactType'
		$val = $CurrentForm->hasValue("ContactType") ? $CurrentForm->getValue("ContactType") : $CurrentForm->getValue("x_ContactType");
		if (!$this->ContactType->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ContactType->Visible = FALSE; // Disable update for API request
			else
				$this->ContactType->setFormValue($val);
		}

		// Check field name 'ContactName' first before field var 'x_ContactName'
		$val = $CurrentForm->hasValue("ContactName") ? $CurrentForm->getValue("ContactName") : $CurrentForm->getValue("x_ContactName");
		if (!$this->ContactName->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ContactName->Visible = FALSE; // Disable update for API request
			else
				$this->ContactName->setFormValue($val);
		}

		// Check field name 'CompanyName' first before field var 'x_CompanyName'
		$val = $CurrentForm->hasValue("CompanyName") ? $CurrentForm->getValue("CompanyName") : $CurrentForm->getValue("x_CompanyName");
		if (!$this->CompanyName->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CompanyName->Visible = FALSE; // Disable update for API request
			else
				$this->CompanyName->setFormValue($val);
		}

		// Check field name 'Address' first before field var 'x_Address'
		$val = $CurrentForm->hasValue("Address") ? $CurrentForm->getValue("Address") : $CurrentForm->getValue("x_Address");
		if (!$this->Address->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Address->Visible = FALSE; // Disable update for API request
			else
				$this->Address->setFormValue($val);
		}

		// Check field name 'ContactPhone' first before field var 'x_ContactPhone'
		$val = $CurrentForm->hasValue("ContactPhone") ? $CurrentForm->getValue("ContactPhone") : $CurrentForm->getValue("x_ContactPhone");
		if (!$this->ContactPhone->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ContactPhone->Visible = FALSE; // Disable update for API request
			else
				$this->ContactPhone->setFormValue($val);
		}

		// Check field name 'ContactEmail' first before field var 'x_ContactEmail'
		$val = $CurrentForm->hasValue("ContactEmail") ? $CurrentForm->getValue("ContactEmail") : $CurrentForm->getValue("x_ContactEmail");
		if (!$this->ContactEmail->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ContactEmail->Visible = FALSE; // Disable update for API request
			else
				$this->ContactEmail->setFormValue($val);
		}

		// Check field name 'ReceiveName' first before field var 'x_ReceiveName'
		$val = $CurrentForm->hasValue("ReceiveName") ? $CurrentForm->getValue("ReceiveName") : $CurrentForm->getValue("x_ReceiveName");
		if (!$this->ReceiveName->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ReceiveName->Visible = FALSE; // Disable update for API request
			else
				$this->ReceiveName->setFormValue($val);
		}

		// Check field name 'ReceiveTime' first before field var 'x_ReceiveTime'
		$val = $CurrentForm->hasValue("ReceiveTime") ? $CurrentForm->getValue("ReceiveTime") : $CurrentForm->getValue("x_ReceiveTime");
		if (!$this->ReceiveTime->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ReceiveTime->Visible = FALSE; // Disable update for API request
			else
				$this->ReceiveTime->setFormValue($val);
		}

		// Check field name 'Note' first before field var 'x_Note'
		$val = $CurrentForm->hasValue("Note") ? $CurrentForm->getValue("Note") : $CurrentForm->getValue("x_Note");
		if (!$this->Note->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Note->Visible = FALSE; // Disable update for API request
			else
				$this->Note->setFormValue($val);
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

		// Check field name 'ID_Contact' first before field var 'x_ID_Contact'
		$val = $CurrentForm->hasValue("ID_Contact") ? $CurrentForm->getValue("ID_Contact") : $CurrentForm->getValue("x_ID_Contact");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->CodeContact->CurrentValue = $this->CodeContact->FormValue;
		$this->ContactType->CurrentValue = $this->ContactType->FormValue;
		$this->ContactName->CurrentValue = $this->ContactName->FormValue;
		$this->CompanyName->CurrentValue = $this->CompanyName->FormValue;
		$this->Address->CurrentValue = $this->Address->FormValue;
		$this->ContactPhone->CurrentValue = $this->ContactPhone->FormValue;
		$this->ContactEmail->CurrentValue = $this->ContactEmail->FormValue;
		$this->ReceiveName->CurrentValue = $this->ReceiveName->FormValue;
		$this->ReceiveTime->CurrentValue = $this->ReceiveTime->FormValue;
		$this->Note->CurrentValue = $this->Note->FormValue;
		$this->CreateUser->CurrentValue = $this->CreateUser->FormValue;
		$this->CreateDate->CurrentValue = $this->CreateDate->FormValue;
		$this->CreateDate->CurrentValue = UnFormatDateTime($this->CreateDate->CurrentValue, 11);
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
		$this->ID_Contact->setDbValue($row['ID_Contact']);
		$this->CodeContact->setDbValue($row['CodeContact']);
		$this->ContactType->setDbValue($row['ContactType']);
		$this->ContactName->setDbValue($row['ContactName']);
		$this->CompanyName->setDbValue($row['CompanyName']);
		$this->Address->setDbValue($row['Address']);
		$this->ContactPhone->setDbValue($row['ContactPhone']);
		$this->ContactEmail->setDbValue($row['ContactEmail']);
		$this->ReceiveName->setDbValue($row['ReceiveName']);
		$this->ReceiveTime->setDbValue($row['ReceiveTime']);
		$this->Note->setDbValue($row['Note']);
		$this->CreateUser->setDbValue($row['CreateUser']);
		$this->CreateDate->setDbValue($row['CreateDate']);
		$this->UpdateUser->setDbValue($row['UpdateUser']);
		$this->UpdateDate->setDbValue($row['UpdateDate']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ID_Contact'] = $this->ID_Contact->CurrentValue;
		$row['CodeContact'] = $this->CodeContact->CurrentValue;
		$row['ContactType'] = $this->ContactType->CurrentValue;
		$row['ContactName'] = $this->ContactName->CurrentValue;
		$row['CompanyName'] = $this->CompanyName->CurrentValue;
		$row['Address'] = $this->Address->CurrentValue;
		$row['ContactPhone'] = $this->ContactPhone->CurrentValue;
		$row['ContactEmail'] = $this->ContactEmail->CurrentValue;
		$row['ReceiveName'] = $this->ReceiveName->CurrentValue;
		$row['ReceiveTime'] = $this->ReceiveTime->CurrentValue;
		$row['Note'] = $this->Note->CurrentValue;
		$row['CreateUser'] = $this->CreateUser->CurrentValue;
		$row['CreateDate'] = $this->CreateDate->CurrentValue;
		$row['UpdateUser'] = $this->UpdateUser->CurrentValue;
		$row['UpdateDate'] = $this->UpdateDate->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ID_Contact")) <> "")
			$this->ID_Contact->CurrentValue = $this->getKey("ID_Contact"); // ID_Contact
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
		// ID_Contact
		// CodeContact
		// ContactType
		// ContactName
		// CompanyName
		// Address
		// ContactPhone
		// ContactEmail
		// ReceiveName
		// ReceiveTime
		// Note
		// CreateUser
		// CreateDate
		// UpdateUser
		// UpdateDate

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// CodeContact
			$this->CodeContact->ViewValue = $this->CodeContact->CurrentValue;
			$this->CodeContact->ViewCustomAttributes = "";

			// ContactType
			if (strval($this->ContactType->CurrentValue) <> "") {
				$this->ContactType->ViewValue = $this->ContactType->optionCaption($this->ContactType->CurrentValue);
			} else {
				$this->ContactType->ViewValue = NULL;
			}
			$this->ContactType->ViewCustomAttributes = "";

			// ContactName
			$this->ContactName->ViewValue = $this->ContactName->CurrentValue;
			$this->ContactName->ViewCustomAttributes = "";

			// CompanyName
			$this->CompanyName->ViewValue = $this->CompanyName->CurrentValue;
			$this->CompanyName->ViewCustomAttributes = "";

			// Address
			$this->Address->ViewValue = $this->Address->CurrentValue;
			$this->Address->ViewCustomAttributes = "";

			// ContactPhone
			$this->ContactPhone->ViewValue = $this->ContactPhone->CurrentValue;
			$this->ContactPhone->ViewCustomAttributes = "";

			// ContactEmail
			$this->ContactEmail->ViewValue = $this->ContactEmail->CurrentValue;
			$this->ContactEmail->ViewCustomAttributes = "";

			// ReceiveName
			$this->ReceiveName->ViewValue = $this->ReceiveName->CurrentValue;
			$this->ReceiveName->ViewCustomAttributes = "";

			// ReceiveTime
			$this->ReceiveTime->ViewValue = $this->ReceiveTime->CurrentValue;
			$this->ReceiveTime->ViewCustomAttributes = "";

			// Note
			$this->Note->ViewValue = $this->Note->CurrentValue;
			$this->Note->ViewCustomAttributes = "";

			// CreateUser
			$this->CreateUser->ViewValue = $this->CreateUser->CurrentValue;
			$this->CreateUser->ViewCustomAttributes = "";

			// CreateDate
			$this->CreateDate->ViewValue = $this->CreateDate->CurrentValue;
			$this->CreateDate->ViewValue = FormatDateTime($this->CreateDate->ViewValue, 11);
			$this->CreateDate->ViewCustomAttributes = "";

			// CodeContact
			$this->CodeContact->LinkCustomAttributes = "";
			$this->CodeContact->HrefValue = "";
			$this->CodeContact->TooltipValue = "";

			// ContactType
			$this->ContactType->LinkCustomAttributes = "";
			$this->ContactType->HrefValue = "";
			$this->ContactType->TooltipValue = "";

			// ContactName
			$this->ContactName->LinkCustomAttributes = "";
			$this->ContactName->HrefValue = "";
			$this->ContactName->TooltipValue = "";

			// CompanyName
			$this->CompanyName->LinkCustomAttributes = "";
			$this->CompanyName->HrefValue = "";
			$this->CompanyName->TooltipValue = "";

			// Address
			$this->Address->LinkCustomAttributes = "";
			$this->Address->HrefValue = "";
			$this->Address->TooltipValue = "";

			// ContactPhone
			$this->ContactPhone->LinkCustomAttributes = "";
			$this->ContactPhone->HrefValue = "";
			$this->ContactPhone->TooltipValue = "";

			// ContactEmail
			$this->ContactEmail->LinkCustomAttributes = "";
			$this->ContactEmail->HrefValue = "";
			$this->ContactEmail->TooltipValue = "";

			// ReceiveName
			$this->ReceiveName->LinkCustomAttributes = "";
			$this->ReceiveName->HrefValue = "";
			$this->ReceiveName->TooltipValue = "";

			// ReceiveTime
			$this->ReceiveTime->LinkCustomAttributes = "";
			$this->ReceiveTime->HrefValue = "";
			$this->ReceiveTime->TooltipValue = "";

			// Note
			$this->Note->LinkCustomAttributes = "";
			$this->Note->HrefValue = "";
			$this->Note->TooltipValue = "";

			// CreateUser
			$this->CreateUser->LinkCustomAttributes = "";
			$this->CreateUser->HrefValue = "";
			$this->CreateUser->TooltipValue = "";

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";
			$this->CreateDate->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// CodeContact
			$this->CodeContact->EditAttrs["class"] = "form-control";
			$this->CodeContact->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->CodeContact->CurrentValue = HtmlDecode($this->CodeContact->CurrentValue);
			$this->CodeContact->EditValue = HtmlEncode($this->CodeContact->CurrentValue);
			$this->CodeContact->PlaceHolder = RemoveHtml($this->CodeContact->caption());

			// ContactType
			$this->ContactType->EditAttrs["class"] = "form-control";
			$this->ContactType->EditCustomAttributes = "";
			$this->ContactType->EditValue = $this->ContactType->options(TRUE);

			// ContactName
			$this->ContactName->EditAttrs["class"] = "form-control";
			$this->ContactName->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->ContactName->CurrentValue = HtmlDecode($this->ContactName->CurrentValue);
			$this->ContactName->EditValue = HtmlEncode($this->ContactName->CurrentValue);
			$this->ContactName->PlaceHolder = RemoveHtml($this->ContactName->caption());

			// CompanyName
			$this->CompanyName->EditAttrs["class"] = "form-control";
			$this->CompanyName->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->CompanyName->CurrentValue = HtmlDecode($this->CompanyName->CurrentValue);
			$this->CompanyName->EditValue = HtmlEncode($this->CompanyName->CurrentValue);
			$this->CompanyName->PlaceHolder = RemoveHtml($this->CompanyName->caption());

			// Address
			$this->Address->EditAttrs["class"] = "form-control";
			$this->Address->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Address->CurrentValue = HtmlDecode($this->Address->CurrentValue);
			$this->Address->EditValue = HtmlEncode($this->Address->CurrentValue);
			$this->Address->PlaceHolder = RemoveHtml($this->Address->caption());

			// ContactPhone
			$this->ContactPhone->EditAttrs["class"] = "form-control";
			$this->ContactPhone->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->ContactPhone->CurrentValue = HtmlDecode($this->ContactPhone->CurrentValue);
			$this->ContactPhone->EditValue = HtmlEncode($this->ContactPhone->CurrentValue);
			$this->ContactPhone->PlaceHolder = RemoveHtml($this->ContactPhone->caption());

			// ContactEmail
			$this->ContactEmail->EditAttrs["class"] = "form-control";
			$this->ContactEmail->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->ContactEmail->CurrentValue = HtmlDecode($this->ContactEmail->CurrentValue);
			$this->ContactEmail->EditValue = HtmlEncode($this->ContactEmail->CurrentValue);
			$this->ContactEmail->PlaceHolder = RemoveHtml($this->ContactEmail->caption());

			// ReceiveName
			$this->ReceiveName->EditAttrs["class"] = "form-control";
			$this->ReceiveName->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->ReceiveName->CurrentValue = HtmlDecode($this->ReceiveName->CurrentValue);
			$this->ReceiveName->EditValue = HtmlEncode($this->ReceiveName->CurrentValue);
			$this->ReceiveName->PlaceHolder = RemoveHtml($this->ReceiveName->caption());

			// ReceiveTime
			$this->ReceiveTime->EditAttrs["class"] = "form-control";
			$this->ReceiveTime->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->ReceiveTime->CurrentValue = HtmlDecode($this->ReceiveTime->CurrentValue);
			$this->ReceiveTime->EditValue = HtmlEncode($this->ReceiveTime->CurrentValue);
			$this->ReceiveTime->PlaceHolder = RemoveHtml($this->ReceiveTime->caption());

			// Note
			$this->Note->EditAttrs["class"] = "form-control";
			$this->Note->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Note->CurrentValue = HtmlDecode($this->Note->CurrentValue);
			$this->Note->EditValue = HtmlEncode($this->Note->CurrentValue);
			$this->Note->PlaceHolder = RemoveHtml($this->Note->caption());

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
			// CodeContact

			$this->CodeContact->LinkCustomAttributes = "";
			$this->CodeContact->HrefValue = "";

			// ContactType
			$this->ContactType->LinkCustomAttributes = "";
			$this->ContactType->HrefValue = "";

			// ContactName
			$this->ContactName->LinkCustomAttributes = "";
			$this->ContactName->HrefValue = "";

			// CompanyName
			$this->CompanyName->LinkCustomAttributes = "";
			$this->CompanyName->HrefValue = "";

			// Address
			$this->Address->LinkCustomAttributes = "";
			$this->Address->HrefValue = "";

			// ContactPhone
			$this->ContactPhone->LinkCustomAttributes = "";
			$this->ContactPhone->HrefValue = "";

			// ContactEmail
			$this->ContactEmail->LinkCustomAttributes = "";
			$this->ContactEmail->HrefValue = "";

			// ReceiveName
			$this->ReceiveName->LinkCustomAttributes = "";
			$this->ReceiveName->HrefValue = "";

			// ReceiveTime
			$this->ReceiveTime->LinkCustomAttributes = "";
			$this->ReceiveTime->HrefValue = "";

			// Note
			$this->Note->LinkCustomAttributes = "";
			$this->Note->HrefValue = "";

			// CreateUser
			$this->CreateUser->LinkCustomAttributes = "";
			$this->CreateUser->HrefValue = "";

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

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->ID_Contact->Required) {
			if (!$this->ID_Contact->IsDetailKey && $this->ID_Contact->FormValue != NULL && $this->ID_Contact->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Contact->caption(), $this->ID_Contact->RequiredErrorMessage));
			}
		}
		if ($this->CodeContact->Required) {
			if (!$this->CodeContact->IsDetailKey && $this->CodeContact->FormValue != NULL && $this->CodeContact->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CodeContact->caption(), $this->CodeContact->RequiredErrorMessage));
			}
		}
		if ($this->ContactType->Required) {
			if (!$this->ContactType->IsDetailKey && $this->ContactType->FormValue != NULL && $this->ContactType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ContactType->caption(), $this->ContactType->RequiredErrorMessage));
			}
		}
		if ($this->ContactName->Required) {
			if (!$this->ContactName->IsDetailKey && $this->ContactName->FormValue != NULL && $this->ContactName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ContactName->caption(), $this->ContactName->RequiredErrorMessage));
			}
		}
		if ($this->CompanyName->Required) {
			if (!$this->CompanyName->IsDetailKey && $this->CompanyName->FormValue != NULL && $this->CompanyName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CompanyName->caption(), $this->CompanyName->RequiredErrorMessage));
			}
		}
		if ($this->Address->Required) {
			if (!$this->Address->IsDetailKey && $this->Address->FormValue != NULL && $this->Address->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Address->caption(), $this->Address->RequiredErrorMessage));
			}
		}
		if ($this->ContactPhone->Required) {
			if (!$this->ContactPhone->IsDetailKey && $this->ContactPhone->FormValue != NULL && $this->ContactPhone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ContactPhone->caption(), $this->ContactPhone->RequiredErrorMessage));
			}
		}
		if ($this->ContactEmail->Required) {
			if (!$this->ContactEmail->IsDetailKey && $this->ContactEmail->FormValue != NULL && $this->ContactEmail->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ContactEmail->caption(), $this->ContactEmail->RequiredErrorMessage));
			}
		}
		if ($this->ReceiveName->Required) {
			if (!$this->ReceiveName->IsDetailKey && $this->ReceiveName->FormValue != NULL && $this->ReceiveName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ReceiveName->caption(), $this->ReceiveName->RequiredErrorMessage));
			}
		}
		if ($this->ReceiveTime->Required) {
			if (!$this->ReceiveTime->IsDetailKey && $this->ReceiveTime->FormValue != NULL && $this->ReceiveTime->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ReceiveTime->caption(), $this->ReceiveTime->RequiredErrorMessage));
			}
		}
		if ($this->Note->Required) {
			if (!$this->Note->IsDetailKey && $this->Note->FormValue != NULL && $this->Note->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Note->caption(), $this->Note->RequiredErrorMessage));
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
		if (!CheckEuroDate($this->CreateDate->FormValue)) {
			AddMessage($FormError, $this->CreateDate->errorMessage());
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

		// CodeContact
		$this->CodeContact->setDbValueDef($rsnew, $this->CodeContact->CurrentValue, NULL, FALSE);

		// ContactType
		$this->ContactType->setDbValueDef($rsnew, $this->ContactType->CurrentValue, NULL, strval($this->ContactType->CurrentValue) == "");

		// ContactName
		$this->ContactName->setDbValueDef($rsnew, $this->ContactName->CurrentValue, NULL, FALSE);

		// CompanyName
		$this->CompanyName->setDbValueDef($rsnew, $this->CompanyName->CurrentValue, NULL, FALSE);

		// Address
		$this->Address->setDbValueDef($rsnew, $this->Address->CurrentValue, NULL, FALSE);

		// ContactPhone
		$this->ContactPhone->setDbValueDef($rsnew, $this->ContactPhone->CurrentValue, NULL, FALSE);

		// ContactEmail
		$this->ContactEmail->setDbValueDef($rsnew, $this->ContactEmail->CurrentValue, NULL, FALSE);

		// ReceiveName
		$this->ReceiveName->setDbValueDef($rsnew, $this->ReceiveName->CurrentValue, NULL, FALSE);

		// ReceiveTime
		$this->ReceiveTime->setDbValueDef($rsnew, $this->ReceiveTime->CurrentValue, NULL, FALSE);

		// Note
		$this->Note->setDbValueDef($rsnew, $this->Note->CurrentValue, NULL, FALSE);

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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tbl_contactlist.php"), "", $this->TableVar, TRUE);
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