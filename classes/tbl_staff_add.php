<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Page class
 */
class tbl_staff_add extends tbl_staff
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{004E2122-9CCA-46AA-835C-0778C5A080BC}";

	// Table name
	public $TableName = 'tbl_staff';

	// Page object name
	public $PageObjName = "tbl_staff_add";

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

		// Table object (tbl_staff)
		if (!isset($GLOBALS["tbl_staff"]) || get_class($GLOBALS["tbl_staff"]) == PROJECT_NAMESPACE . "tbl_staff") {
			$GLOBALS["tbl_staff"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_staff"];
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
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_staff');

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
		global $EXPORT, $tbl_staff;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_staff);
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
					if ($pageName == "tbl_staffview.php")
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
			$key .= @$ar['Ma_NV'];
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
					$this->terminate(GetUrl("tbl_stafflist.php"));
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
		$this->Ma_NV->setVisibility();
		$this->hoVaTen->setVisibility();
		$this->gioiTinh->setVisibility();
		$this->ngaySinh->setVisibility();
		$this->emailCaNhan->setVisibility();
		$this->CD_ID->setVisibility();
		$this->TD_ID->setVisibility();
		$this->PB_ID->setVisibility();
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
			if (Get("Ma_NV") !== NULL) {
				$this->Ma_NV->setQueryStringValue(Get("Ma_NV"));
				$this->setKey("Ma_NV", $this->Ma_NV->CurrentValue); // Set up key
			} else {
				$this->setKey("Ma_NV", ""); // Clear key
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
					$this->terminate("tbl_stafflist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "tbl_stafflist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "tbl_staffview.php")
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
		$this->Ma_NV->CurrentValue = NULL;
		$this->Ma_NV->OldValue = $this->Ma_NV->CurrentValue;
		$this->hoVaTen->CurrentValue = NULL;
		$this->hoVaTen->OldValue = $this->hoVaTen->CurrentValue;
		$this->gioiTinh->CurrentValue = NULL;
		$this->gioiTinh->OldValue = $this->gioiTinh->CurrentValue;
		$this->ngaySinh->CurrentValue = NULL;
		$this->ngaySinh->OldValue = $this->ngaySinh->CurrentValue;
		$this->emailCaNhan->CurrentValue = NULL;
		$this->emailCaNhan->OldValue = $this->emailCaNhan->CurrentValue;
		$this->CD_ID->CurrentValue = NULL;
		$this->CD_ID->OldValue = $this->CD_ID->CurrentValue;
		$this->TD_ID->CurrentValue = NULL;
		$this->TD_ID->OldValue = $this->TD_ID->CurrentValue;
		$this->PB_ID->CurrentValue = NULL;
		$this->PB_ID->OldValue = $this->PB_ID->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'Ma_NV' first before field var 'x_Ma_NV'
		$val = $CurrentForm->hasValue("Ma_NV") ? $CurrentForm->getValue("Ma_NV") : $CurrentForm->getValue("x_Ma_NV");
		if (!$this->Ma_NV->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Ma_NV->Visible = FALSE; // Disable update for API request
			else
				$this->Ma_NV->setFormValue($val);
		}

		// Check field name 'hoVaTen' first before field var 'x_hoVaTen'
		$val = $CurrentForm->hasValue("hoVaTen") ? $CurrentForm->getValue("hoVaTen") : $CurrentForm->getValue("x_hoVaTen");
		if (!$this->hoVaTen->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->hoVaTen->Visible = FALSE; // Disable update for API request
			else
				$this->hoVaTen->setFormValue($val);
		}

		// Check field name 'gioiTinh' first before field var 'x_gioiTinh'
		$val = $CurrentForm->hasValue("gioiTinh") ? $CurrentForm->getValue("gioiTinh") : $CurrentForm->getValue("x_gioiTinh");
		if (!$this->gioiTinh->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->gioiTinh->Visible = FALSE; // Disable update for API request
			else
				$this->gioiTinh->setFormValue($val);
		}

		// Check field name 'ngaySinh' first before field var 'x_ngaySinh'
		$val = $CurrentForm->hasValue("ngaySinh") ? $CurrentForm->getValue("ngaySinh") : $CurrentForm->getValue("x_ngaySinh");
		if (!$this->ngaySinh->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ngaySinh->Visible = FALSE; // Disable update for API request
			else
				$this->ngaySinh->setFormValue($val);
			$this->ngaySinh->CurrentValue = UnFormatDateTime($this->ngaySinh->CurrentValue, 0);
		}

		// Check field name 'emailCaNhan' first before field var 'x_emailCaNhan'
		$val = $CurrentForm->hasValue("emailCaNhan") ? $CurrentForm->getValue("emailCaNhan") : $CurrentForm->getValue("x_emailCaNhan");
		if (!$this->emailCaNhan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->emailCaNhan->Visible = FALSE; // Disable update for API request
			else
				$this->emailCaNhan->setFormValue($val);
		}

		// Check field name 'CD_ID' first before field var 'x_CD_ID'
		$val = $CurrentForm->hasValue("CD_ID") ? $CurrentForm->getValue("CD_ID") : $CurrentForm->getValue("x_CD_ID");
		if (!$this->CD_ID->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CD_ID->Visible = FALSE; // Disable update for API request
			else
				$this->CD_ID->setFormValue($val);
		}

		// Check field name 'TD_ID' first before field var 'x_TD_ID'
		$val = $CurrentForm->hasValue("TD_ID") ? $CurrentForm->getValue("TD_ID") : $CurrentForm->getValue("x_TD_ID");
		if (!$this->TD_ID->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->TD_ID->Visible = FALSE; // Disable update for API request
			else
				$this->TD_ID->setFormValue($val);
		}

		// Check field name 'PB_ID' first before field var 'x_PB_ID'
		$val = $CurrentForm->hasValue("PB_ID") ? $CurrentForm->getValue("PB_ID") : $CurrentForm->getValue("x_PB_ID");
		if (!$this->PB_ID->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PB_ID->Visible = FALSE; // Disable update for API request
			else
				$this->PB_ID->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->Ma_NV->CurrentValue = $this->Ma_NV->FormValue;
		$this->hoVaTen->CurrentValue = $this->hoVaTen->FormValue;
		$this->gioiTinh->CurrentValue = $this->gioiTinh->FormValue;
		$this->ngaySinh->CurrentValue = $this->ngaySinh->FormValue;
		$this->ngaySinh->CurrentValue = UnFormatDateTime($this->ngaySinh->CurrentValue, 0);
		$this->emailCaNhan->CurrentValue = $this->emailCaNhan->FormValue;
		$this->CD_ID->CurrentValue = $this->CD_ID->FormValue;
		$this->TD_ID->CurrentValue = $this->TD_ID->FormValue;
		$this->PB_ID->CurrentValue = $this->PB_ID->FormValue;
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
		$this->Ma_NV->setDbValue($row['Ma_NV']);
		$this->hoVaTen->setDbValue($row['hoVaTen']);
		$this->gioiTinh->setDbValue($row['gioiTinh']);
		$this->ngaySinh->setDbValue($row['ngaySinh']);
		$this->emailCaNhan->setDbValue($row['emailCaNhan']);
		$this->CD_ID->setDbValue($row['CD_ID']);
		$this->TD_ID->setDbValue($row['TD_ID']);
		$this->PB_ID->setDbValue($row['PB_ID']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['Ma_NV'] = $this->Ma_NV->CurrentValue;
		$row['hoVaTen'] = $this->hoVaTen->CurrentValue;
		$row['gioiTinh'] = $this->gioiTinh->CurrentValue;
		$row['ngaySinh'] = $this->ngaySinh->CurrentValue;
		$row['emailCaNhan'] = $this->emailCaNhan->CurrentValue;
		$row['CD_ID'] = $this->CD_ID->CurrentValue;
		$row['TD_ID'] = $this->TD_ID->CurrentValue;
		$row['PB_ID'] = $this->PB_ID->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("Ma_NV")) <> "")
			$this->Ma_NV->CurrentValue = $this->getKey("Ma_NV"); // Ma_NV
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
		// Ma_NV
		// hoVaTen
		// gioiTinh
		// ngaySinh
		// emailCaNhan
		// CD_ID
		// TD_ID
		// PB_ID

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// Ma_NV
			$this->Ma_NV->ViewValue = $this->Ma_NV->CurrentValue;
			$this->Ma_NV->ViewCustomAttributes = "";

			// hoVaTen
			$this->hoVaTen->ViewValue = $this->hoVaTen->CurrentValue;
			$this->hoVaTen->ViewCustomAttributes = "";

			// gioiTinh
			$this->gioiTinh->ViewValue = $this->gioiTinh->CurrentValue;
			$this->gioiTinh->ViewCustomAttributes = "";

			// ngaySinh
			$this->ngaySinh->ViewValue = $this->ngaySinh->CurrentValue;
			$this->ngaySinh->ViewValue = FormatDateTime($this->ngaySinh->ViewValue, 0);
			$this->ngaySinh->ViewCustomAttributes = "";

			// emailCaNhan
			$this->emailCaNhan->ViewValue = $this->emailCaNhan->CurrentValue;
			$this->emailCaNhan->ViewCustomAttributes = "";

			// CD_ID
			$this->CD_ID->ViewValue = $this->CD_ID->CurrentValue;
			$this->CD_ID->ViewValue = FormatNumber($this->CD_ID->ViewValue, 0, -2, -2, -2);
			$this->CD_ID->ViewCustomAttributes = "";

			// TD_ID
			$this->TD_ID->ViewValue = $this->TD_ID->CurrentValue;
			$this->TD_ID->ViewValue = FormatNumber($this->TD_ID->ViewValue, 0, -2, -2, -2);
			$this->TD_ID->ViewCustomAttributes = "";

			// PB_ID
			$this->PB_ID->ViewValue = $this->PB_ID->CurrentValue;
			$this->PB_ID->ViewValue = FormatNumber($this->PB_ID->ViewValue, 0, -2, -2, -2);
			$this->PB_ID->ViewCustomAttributes = "";

			// Ma_NV
			$this->Ma_NV->LinkCustomAttributes = "";
			$this->Ma_NV->HrefValue = "";
			$this->Ma_NV->TooltipValue = "";

			// hoVaTen
			$this->hoVaTen->LinkCustomAttributes = "";
			$this->hoVaTen->HrefValue = "";
			$this->hoVaTen->TooltipValue = "";

			// gioiTinh
			$this->gioiTinh->LinkCustomAttributes = "";
			$this->gioiTinh->HrefValue = "";
			$this->gioiTinh->TooltipValue = "";

			// ngaySinh
			$this->ngaySinh->LinkCustomAttributes = "";
			$this->ngaySinh->HrefValue = "";
			$this->ngaySinh->TooltipValue = "";

			// emailCaNhan
			$this->emailCaNhan->LinkCustomAttributes = "";
			$this->emailCaNhan->HrefValue = "";
			$this->emailCaNhan->TooltipValue = "";

			// CD_ID
			$this->CD_ID->LinkCustomAttributes = "";
			$this->CD_ID->HrefValue = "";
			$this->CD_ID->TooltipValue = "";

			// TD_ID
			$this->TD_ID->LinkCustomAttributes = "";
			$this->TD_ID->HrefValue = "";
			$this->TD_ID->TooltipValue = "";

			// PB_ID
			$this->PB_ID->LinkCustomAttributes = "";
			$this->PB_ID->HrefValue = "";
			$this->PB_ID->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// Ma_NV
			$this->Ma_NV->EditAttrs["class"] = "form-control";
			$this->Ma_NV->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Ma_NV->CurrentValue = HtmlDecode($this->Ma_NV->CurrentValue);
			$this->Ma_NV->EditValue = HtmlEncode($this->Ma_NV->CurrentValue);
			$this->Ma_NV->PlaceHolder = RemoveHtml($this->Ma_NV->caption());

			// hoVaTen
			$this->hoVaTen->EditAttrs["class"] = "form-control";
			$this->hoVaTen->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->hoVaTen->CurrentValue = HtmlDecode($this->hoVaTen->CurrentValue);
			$this->hoVaTen->EditValue = HtmlEncode($this->hoVaTen->CurrentValue);
			$this->hoVaTen->PlaceHolder = RemoveHtml($this->hoVaTen->caption());

			// gioiTinh
			$this->gioiTinh->EditAttrs["class"] = "form-control";
			$this->gioiTinh->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->gioiTinh->CurrentValue = HtmlDecode($this->gioiTinh->CurrentValue);
			$this->gioiTinh->EditValue = HtmlEncode($this->gioiTinh->CurrentValue);
			$this->gioiTinh->PlaceHolder = RemoveHtml($this->gioiTinh->caption());

			// ngaySinh
			$this->ngaySinh->EditAttrs["class"] = "form-control";
			$this->ngaySinh->EditCustomAttributes = "";
			$this->ngaySinh->EditValue = HtmlEncode(FormatDateTime($this->ngaySinh->CurrentValue, 8));
			$this->ngaySinh->PlaceHolder = RemoveHtml($this->ngaySinh->caption());

			// emailCaNhan
			$this->emailCaNhan->EditAttrs["class"] = "form-control";
			$this->emailCaNhan->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->emailCaNhan->CurrentValue = HtmlDecode($this->emailCaNhan->CurrentValue);
			$this->emailCaNhan->EditValue = HtmlEncode($this->emailCaNhan->CurrentValue);
			$this->emailCaNhan->PlaceHolder = RemoveHtml($this->emailCaNhan->caption());

			// CD_ID
			$this->CD_ID->EditAttrs["class"] = "form-control";
			$this->CD_ID->EditCustomAttributes = "";
			$this->CD_ID->EditValue = HtmlEncode($this->CD_ID->CurrentValue);
			$this->CD_ID->PlaceHolder = RemoveHtml($this->CD_ID->caption());

			// TD_ID
			$this->TD_ID->EditAttrs["class"] = "form-control";
			$this->TD_ID->EditCustomAttributes = "";
			$this->TD_ID->EditValue = HtmlEncode($this->TD_ID->CurrentValue);
			$this->TD_ID->PlaceHolder = RemoveHtml($this->TD_ID->caption());

			// PB_ID
			$this->PB_ID->EditAttrs["class"] = "form-control";
			$this->PB_ID->EditCustomAttributes = "";
			$this->PB_ID->EditValue = HtmlEncode($this->PB_ID->CurrentValue);
			$this->PB_ID->PlaceHolder = RemoveHtml($this->PB_ID->caption());

			// Add refer script
			// Ma_NV

			$this->Ma_NV->LinkCustomAttributes = "";
			$this->Ma_NV->HrefValue = "";

			// hoVaTen
			$this->hoVaTen->LinkCustomAttributes = "";
			$this->hoVaTen->HrefValue = "";

			// gioiTinh
			$this->gioiTinh->LinkCustomAttributes = "";
			$this->gioiTinh->HrefValue = "";

			// ngaySinh
			$this->ngaySinh->LinkCustomAttributes = "";
			$this->ngaySinh->HrefValue = "";

			// emailCaNhan
			$this->emailCaNhan->LinkCustomAttributes = "";
			$this->emailCaNhan->HrefValue = "";

			// CD_ID
			$this->CD_ID->LinkCustomAttributes = "";
			$this->CD_ID->HrefValue = "";

			// TD_ID
			$this->TD_ID->LinkCustomAttributes = "";
			$this->TD_ID->HrefValue = "";

			// PB_ID
			$this->PB_ID->LinkCustomAttributes = "";
			$this->PB_ID->HrefValue = "";
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
		if ($this->Ma_NV->Required) {
			if (!$this->Ma_NV->IsDetailKey && $this->Ma_NV->FormValue != NULL && $this->Ma_NV->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Ma_NV->caption(), $this->Ma_NV->RequiredErrorMessage));
			}
		}
		if ($this->hoVaTen->Required) {
			if (!$this->hoVaTen->IsDetailKey && $this->hoVaTen->FormValue != NULL && $this->hoVaTen->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->hoVaTen->caption(), $this->hoVaTen->RequiredErrorMessage));
			}
		}
		if ($this->gioiTinh->Required) {
			if (!$this->gioiTinh->IsDetailKey && $this->gioiTinh->FormValue != NULL && $this->gioiTinh->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->gioiTinh->caption(), $this->gioiTinh->RequiredErrorMessage));
			}
		}
		if ($this->ngaySinh->Required) {
			if (!$this->ngaySinh->IsDetailKey && $this->ngaySinh->FormValue != NULL && $this->ngaySinh->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ngaySinh->caption(), $this->ngaySinh->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ngaySinh->FormValue)) {
			AddMessage($FormError, $this->ngaySinh->errorMessage());
		}
		if ($this->emailCaNhan->Required) {
			if (!$this->emailCaNhan->IsDetailKey && $this->emailCaNhan->FormValue != NULL && $this->emailCaNhan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->emailCaNhan->caption(), $this->emailCaNhan->RequiredErrorMessage));
			}
		}
		if ($this->CD_ID->Required) {
			if (!$this->CD_ID->IsDetailKey && $this->CD_ID->FormValue != NULL && $this->CD_ID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CD_ID->caption(), $this->CD_ID->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->CD_ID->FormValue)) {
			AddMessage($FormError, $this->CD_ID->errorMessage());
		}
		if ($this->TD_ID->Required) {
			if (!$this->TD_ID->IsDetailKey && $this->TD_ID->FormValue != NULL && $this->TD_ID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TD_ID->caption(), $this->TD_ID->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->TD_ID->FormValue)) {
			AddMessage($FormError, $this->TD_ID->errorMessage());
		}
		if ($this->PB_ID->Required) {
			if (!$this->PB_ID->IsDetailKey && $this->PB_ID->FormValue != NULL && $this->PB_ID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PB_ID->caption(), $this->PB_ID->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PB_ID->FormValue)) {
			AddMessage($FormError, $this->PB_ID->errorMessage());
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

		// Ma_NV
		$this->Ma_NV->setDbValueDef($rsnew, $this->Ma_NV->CurrentValue, "", FALSE);

		// hoVaTen
		$this->hoVaTen->setDbValueDef($rsnew, $this->hoVaTen->CurrentValue, NULL, FALSE);

		// gioiTinh
		$this->gioiTinh->setDbValueDef($rsnew, $this->gioiTinh->CurrentValue, NULL, FALSE);

		// ngaySinh
		$this->ngaySinh->setDbValueDef($rsnew, UnFormatDateTime($this->ngaySinh->CurrentValue, 0), NULL, FALSE);

		// emailCaNhan
		$this->emailCaNhan->setDbValueDef($rsnew, $this->emailCaNhan->CurrentValue, NULL, FALSE);

		// CD_ID
		$this->CD_ID->setDbValueDef($rsnew, $this->CD_ID->CurrentValue, NULL, FALSE);

		// TD_ID
		$this->TD_ID->setDbValueDef($rsnew, $this->TD_ID->CurrentValue, NULL, FALSE);

		// PB_ID
		$this->PB_ID->setDbValueDef($rsnew, $this->PB_ID->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['Ma_NV']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check for duplicate key
		if ($insertRow && $this->ValidateKey) {
			$filter = $this->getRecordFilter();
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
				$this->setFailureMessage($keyErrMsg);
				$rsChk->close();
				$insertRow = FALSE;
			}
		}
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tbl_stafflist.php"), "", $this->TableVar, TRUE);
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