<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Page class
 */
class tbl_contact_edit extends tbl_contact
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{004E2122-9CCA-46AA-835C-0778C5A080BC}";

	// Table name
	public $TableName = 'tbl_contact';

	// Page object name
	public $PageObjName = "tbl_contact_edit";

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
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

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
		$this->CreateUser->Visible = FALSE;
		$this->CreateDate->Visible = FALSE;
		$this->UpdateUser->setVisibility();
		$this->UpdateDate->setVisibility();
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
			if ($CurrentForm->hasValue("x_ID_Contact")) {
				$this->ID_Contact->setFormValue($CurrentForm->getValue("x_ID_Contact"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("ID_Contact") !== NULL) {
				$this->ID_Contact->setQueryStringValue(Get("ID_Contact"));
				$loadByQuery = TRUE;
			} else {
				$this->ID_Contact->CurrentValue = NULL;
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
					$this->terminate("tbl_contactlist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "tbl_contactlist.php")
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

		// Check field name 'UpdateUser' first before field var 'x_UpdateUser'
		$val = $CurrentForm->hasValue("UpdateUser") ? $CurrentForm->getValue("UpdateUser") : $CurrentForm->getValue("x_UpdateUser");
		if (!$this->UpdateUser->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->UpdateUser->Visible = FALSE; // Disable update for API request
			else
				$this->UpdateUser->setFormValue($val);
		}

		// Check field name 'UpdateDate' first before field var 'x_UpdateDate'
		$val = $CurrentForm->hasValue("UpdateDate") ? $CurrentForm->getValue("UpdateDate") : $CurrentForm->getValue("x_UpdateDate");
		if (!$this->UpdateDate->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->UpdateDate->Visible = FALSE; // Disable update for API request
			else
				$this->UpdateDate->setFormValue($val);
			$this->UpdateDate->CurrentValue = UnFormatDateTime($this->UpdateDate->CurrentValue, 11);
		}

		// Check field name 'ID_Contact' first before field var 'x_ID_Contact'
		$val = $CurrentForm->hasValue("ID_Contact") ? $CurrentForm->getValue("ID_Contact") : $CurrentForm->getValue("x_ID_Contact");
		if (!$this->ID_Contact->IsDetailKey)
			$this->ID_Contact->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ID_Contact->CurrentValue = $this->ID_Contact->FormValue;
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
		$this->UpdateUser->CurrentValue = $this->UpdateUser->FormValue;
		$this->UpdateDate->CurrentValue = $this->UpdateDate->FormValue;
		$this->UpdateDate->CurrentValue = UnFormatDateTime($this->UpdateDate->CurrentValue, 11);
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
		$row = [];
		$row['ID_Contact'] = NULL;
		$row['CodeContact'] = NULL;
		$row['ContactType'] = NULL;
		$row['ContactName'] = NULL;
		$row['CompanyName'] = NULL;
		$row['Address'] = NULL;
		$row['ContactPhone'] = NULL;
		$row['ContactEmail'] = NULL;
		$row['ReceiveName'] = NULL;
		$row['ReceiveTime'] = NULL;
		$row['Note'] = NULL;
		$row['CreateUser'] = NULL;
		$row['CreateDate'] = NULL;
		$row['UpdateUser'] = NULL;
		$row['UpdateDate'] = NULL;
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

			// UpdateUser
			$this->UpdateUser->ViewValue = $this->UpdateUser->CurrentValue;
			$this->UpdateUser->ViewCustomAttributes = "";

			// UpdateDate
			$this->UpdateDate->ViewValue = $this->UpdateDate->CurrentValue;
			$this->UpdateDate->ViewValue = FormatDateTime($this->UpdateDate->ViewValue, 11);
			$this->UpdateDate->ViewCustomAttributes = "";

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

			// UpdateUser
			$this->UpdateUser->LinkCustomAttributes = "";
			$this->UpdateUser->HrefValue = "";
			$this->UpdateUser->TooltipValue = "";

			// UpdateDate
			$this->UpdateDate->LinkCustomAttributes = "";
			$this->UpdateDate->HrefValue = "";
			$this->UpdateDate->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

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

			// UpdateUser
			$this->UpdateUser->EditAttrs["class"] = "form-control";
			$this->UpdateUser->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->UpdateUser->CurrentValue = HtmlDecode($this->UpdateUser->CurrentValue);
			$this->UpdateUser->EditValue = HtmlEncode($this->UpdateUser->CurrentValue);
			$this->UpdateUser->PlaceHolder = RemoveHtml($this->UpdateUser->caption());

			// UpdateDate
			$this->UpdateDate->EditAttrs["class"] = "form-control";
			$this->UpdateDate->EditCustomAttributes = "";
			$this->UpdateDate->EditValue = HtmlEncode(FormatDateTime($this->UpdateDate->CurrentValue, 11));
			$this->UpdateDate->PlaceHolder = RemoveHtml($this->UpdateDate->caption());

			// Edit refer script
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

			// UpdateUser
			$this->UpdateUser->LinkCustomAttributes = "";
			$this->UpdateUser->HrefValue = "";

			// UpdateDate
			$this->UpdateDate->LinkCustomAttributes = "";
			$this->UpdateDate->HrefValue = "";
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
		if (!CheckEuroDate($this->UpdateDate->FormValue)) {
			AddMessage($FormError, $this->UpdateDate->errorMessage());
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

			// CodeContact
			$this->CodeContact->setDbValueDef($rsnew, $this->CodeContact->CurrentValue, NULL, $this->CodeContact->ReadOnly);

			// ContactType
			$this->ContactType->setDbValueDef($rsnew, $this->ContactType->CurrentValue, NULL, $this->ContactType->ReadOnly);

			// ContactName
			$this->ContactName->setDbValueDef($rsnew, $this->ContactName->CurrentValue, NULL, $this->ContactName->ReadOnly);

			// CompanyName
			$this->CompanyName->setDbValueDef($rsnew, $this->CompanyName->CurrentValue, NULL, $this->CompanyName->ReadOnly);

			// Address
			$this->Address->setDbValueDef($rsnew, $this->Address->CurrentValue, NULL, $this->Address->ReadOnly);

			// ContactPhone
			$this->ContactPhone->setDbValueDef($rsnew, $this->ContactPhone->CurrentValue, NULL, $this->ContactPhone->ReadOnly);

			// ContactEmail
			$this->ContactEmail->setDbValueDef($rsnew, $this->ContactEmail->CurrentValue, NULL, $this->ContactEmail->ReadOnly);

			// ReceiveName
			$this->ReceiveName->setDbValueDef($rsnew, $this->ReceiveName->CurrentValue, NULL, $this->ReceiveName->ReadOnly);

			// ReceiveTime
			$this->ReceiveTime->setDbValueDef($rsnew, $this->ReceiveTime->CurrentValue, NULL, $this->ReceiveTime->ReadOnly);

			// Note
			$this->Note->setDbValueDef($rsnew, $this->Note->CurrentValue, NULL, $this->Note->ReadOnly);

			// UpdateUser
			$this->UpdateUser->setDbValueDef($rsnew, $this->UpdateUser->CurrentValue, NULL, $this->UpdateUser->ReadOnly);

			// UpdateDate
			$this->UpdateDate->setDbValueDef($rsnew, UnFormatDateTime($this->UpdateDate->CurrentValue, 11), NULL, $this->UpdateDate->ReadOnly);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tbl_contactlist.php"), "", $this->TableVar, TRUE);
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