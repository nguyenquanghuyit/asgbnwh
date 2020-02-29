<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Page class
 */
class tbl_route_add extends tbl_route
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{004E2122-9CCA-46AA-835C-0778C5A080BC}";

	// Table name
	public $TableName = 'tbl_route';

	// Page object name
	public $PageObjName = "tbl_route_add";

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
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (tbl_user)
		if (!isset($GLOBALS['tbl_user']))
			$GLOBALS['tbl_user'] = new tbl_user();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "tbl_routeview.php")
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
					$this->terminate(GetUrl("tbl_routelist.php"));
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
		$this->FinishUnload->Visible = FALSE;
		$this->SealNo->Visible = FALSE;
		$this->DepartureTime->Visible = FALSE;
		$this->FinishLoading->Visible = FALSE;
		$this->AttachFile->setVisibility();
		$this->LoadingID->setVisibility();
		$this->Id_Type->setVisibility();
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
			if (Get("ID_Route") !== NULL) {
				$this->ID_Route->setQueryStringValue(Get("ID_Route"));
				$this->setKey("ID_Route", $this->ID_Route->CurrentValue); // Set up key
			} else {
				$this->setKey("ID_Route", ""); // Clear key
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

		// Set up detail parameters
		$this->setupDetailParms();

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
					$this->terminate("tbl_routelist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() <> "") // Master/detail add
						$returnUrl = $this->getDetailUrl();
					else
						$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "tbl_routelist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "tbl_routeview.php")
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

					// Set up detail parameters
					$this->setupDetailParms();
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
		$this->AttachFile->Upload->Index = $CurrentForm->Index;
		$this->AttachFile->Upload->uploadFile();
		$this->AttachFile->CurrentValue = $this->AttachFile->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->ID_Route->CurrentValue = NULL;
		$this->ID_Route->OldValue = $this->ID_Route->CurrentValue;
		$this->RouteName->CurrentValue = 'TO ASGBN';
		$this->TruckNo->CurrentValue = NULL;
		$this->TruckNo->OldValue = $this->TruckNo->CurrentValue;
		$this->DriverName->CurrentValue = NULL;
		$this->DriverName->OldValue = $this->DriverName->CurrentValue;
		$this->DriverMobile->CurrentValue = NULL;
		$this->DriverMobile->OldValue = $this->DriverMobile->CurrentValue;
		$this->InvoiceNo->CurrentValue = NULL;
		$this->InvoiceNo->OldValue = $this->InvoiceNo->CurrentValue;
		$this->InvoiceDate->CurrentValue = CurrentDateTime();
		$this->CreateUser->CurrentValue = CurrentUserName();
		$this->CreateDate->CurrentValue = CurrentDateTime();
		$this->UpdateUser->CurrentValue = NULL;
		$this->UpdateUser->OldValue = $this->UpdateUser->CurrentValue;
		$this->UpdateDate->CurrentValue = NULL;
		$this->UpdateDate->OldValue = $this->UpdateDate->CurrentValue;
		$this->InOrOut->CurrentValue = NULL;
		$this->InOrOut->OldValue = $this->InOrOut->CurrentValue;
		$this->FinishUnload->CurrentValue = 1;
		$this->SealNo->CurrentValue = NULL;
		$this->SealNo->OldValue = $this->SealNo->CurrentValue;
		$this->DepartureTime->CurrentValue = NULL;
		$this->DepartureTime->OldValue = $this->DepartureTime->CurrentValue;
		$this->FinishLoading->CurrentValue = NULL;
		$this->FinishLoading->OldValue = $this->FinishLoading->CurrentValue;
		$this->AttachFile->Upload->DbValue = NULL;
		$this->AttachFile->OldValue = $this->AttachFile->Upload->DbValue;
		$this->AttachFile->CurrentValue = NULL; // Clear file related field
		$this->LoadingID->CurrentValue = NULL;
		$this->LoadingID->OldValue = $this->LoadingID->CurrentValue;
		$this->Id_Type->CurrentValue = NULL;
		$this->Id_Type->OldValue = $this->Id_Type->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'RouteName' first before field var 'x_RouteName'
		$val = $CurrentForm->hasValue("RouteName") ? $CurrentForm->getValue("RouteName") : $CurrentForm->getValue("x_RouteName");
		if (!$this->RouteName->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->RouteName->Visible = FALSE; // Disable update for API request
			else
				$this->RouteName->setFormValue($val);
		}

		// Check field name 'TruckNo' first before field var 'x_TruckNo'
		$val = $CurrentForm->hasValue("TruckNo") ? $CurrentForm->getValue("TruckNo") : $CurrentForm->getValue("x_TruckNo");
		if (!$this->TruckNo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->TruckNo->Visible = FALSE; // Disable update for API request
			else
				$this->TruckNo->setFormValue($val);
		}

		// Check field name 'DriverName' first before field var 'x_DriverName'
		$val = $CurrentForm->hasValue("DriverName") ? $CurrentForm->getValue("DriverName") : $CurrentForm->getValue("x_DriverName");
		if (!$this->DriverName->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DriverName->Visible = FALSE; // Disable update for API request
			else
				$this->DriverName->setFormValue($val);
		}

		// Check field name 'DriverMobile' first before field var 'x_DriverMobile'
		$val = $CurrentForm->hasValue("DriverMobile") ? $CurrentForm->getValue("DriverMobile") : $CurrentForm->getValue("x_DriverMobile");
		if (!$this->DriverMobile->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DriverMobile->Visible = FALSE; // Disable update for API request
			else
				$this->DriverMobile->setFormValue($val);
		}

		// Check field name 'InvoiceNo' first before field var 'x_InvoiceNo'
		$val = $CurrentForm->hasValue("InvoiceNo") ? $CurrentForm->getValue("InvoiceNo") : $CurrentForm->getValue("x_InvoiceNo");
		if (!$this->InvoiceNo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->InvoiceNo->Visible = FALSE; // Disable update for API request
			else
				$this->InvoiceNo->setFormValue($val);
		}

		// Check field name 'InvoiceDate' first before field var 'x_InvoiceDate'
		$val = $CurrentForm->hasValue("InvoiceDate") ? $CurrentForm->getValue("InvoiceDate") : $CurrentForm->getValue("x_InvoiceDate");
		if (!$this->InvoiceDate->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->InvoiceDate->Visible = FALSE; // Disable update for API request
			else
				$this->InvoiceDate->setFormValue($val);
			$this->InvoiceDate->CurrentValue = UnFormatDateTime($this->InvoiceDate->CurrentValue, 7);
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

		// Check field name 'LoadingID' first before field var 'x_LoadingID'
		$val = $CurrentForm->hasValue("LoadingID") ? $CurrentForm->getValue("LoadingID") : $CurrentForm->getValue("x_LoadingID");
		if (!$this->LoadingID->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->LoadingID->Visible = FALSE; // Disable update for API request
			else
				$this->LoadingID->setFormValue($val);
		}

		// Check field name 'Id_Type' first before field var 'x_Id_Type'
		$val = $CurrentForm->hasValue("Id_Type") ? $CurrentForm->getValue("Id_Type") : $CurrentForm->getValue("x_Id_Type");
		if (!$this->Id_Type->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Id_Type->Visible = FALSE; // Disable update for API request
			else
				$this->Id_Type->setFormValue($val);
		}

		// Check field name 'ID_Route' first before field var 'x_ID_Route'
		$val = $CurrentForm->hasValue("ID_Route") ? $CurrentForm->getValue("ID_Route") : $CurrentForm->getValue("x_ID_Route");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->RouteName->CurrentValue = $this->RouteName->FormValue;
		$this->TruckNo->CurrentValue = $this->TruckNo->FormValue;
		$this->DriverName->CurrentValue = $this->DriverName->FormValue;
		$this->DriverMobile->CurrentValue = $this->DriverMobile->FormValue;
		$this->InvoiceNo->CurrentValue = $this->InvoiceNo->FormValue;
		$this->InvoiceDate->CurrentValue = $this->InvoiceDate->FormValue;
		$this->InvoiceDate->CurrentValue = UnFormatDateTime($this->InvoiceDate->CurrentValue, 7);
		$this->CreateUser->CurrentValue = $this->CreateUser->FormValue;
		$this->CreateDate->CurrentValue = $this->CreateDate->FormValue;
		$this->CreateDate->CurrentValue = UnFormatDateTime($this->CreateDate->CurrentValue, 11);
		$this->LoadingID->CurrentValue = $this->LoadingID->FormValue;
		$this->Id_Type->CurrentValue = $this->Id_Type->FormValue;
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
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ID_Route'] = $this->ID_Route->CurrentValue;
		$row['RouteName'] = $this->RouteName->CurrentValue;
		$row['TruckNo'] = $this->TruckNo->CurrentValue;
		$row['DriverName'] = $this->DriverName->CurrentValue;
		$row['DriverMobile'] = $this->DriverMobile->CurrentValue;
		$row['InvoiceNo'] = $this->InvoiceNo->CurrentValue;
		$row['InvoiceDate'] = $this->InvoiceDate->CurrentValue;
		$row['CreateUser'] = $this->CreateUser->CurrentValue;
		$row['CreateDate'] = $this->CreateDate->CurrentValue;
		$row['UpdateUser'] = $this->UpdateUser->CurrentValue;
		$row['UpdateDate'] = $this->UpdateDate->CurrentValue;
		$row['InOrOut'] = $this->InOrOut->CurrentValue;
		$row['FinishUnload'] = $this->FinishUnload->CurrentValue;
		$row['SealNo'] = $this->SealNo->CurrentValue;
		$row['DepartureTime'] = $this->DepartureTime->CurrentValue;
		$row['FinishLoading'] = $this->FinishLoading->CurrentValue;
		$row['AttachFile'] = $this->AttachFile->Upload->DbValue;
		$row['LoadingID'] = $this->LoadingID->CurrentValue;
		$row['Id_Type'] = $this->Id_Type->CurrentValue;
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// ID_Route
		// RouteName
		// TruckNo
		// DriverName
		// DriverMobile
		// InvoiceNo
		// InvoiceDate
		// CreateUser
		// CreateDate
		// UpdateUser
		// UpdateDate
		// InOrOut
		// FinishUnload
		// SealNo
		// DepartureTime
		// FinishLoading
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

			// DriverName
			$this->DriverName->LinkCustomAttributes = "";
			$this->DriverName->HrefValue = "";
			$this->DriverName->TooltipValue = "";

			// DriverMobile
			$this->DriverMobile->LinkCustomAttributes = "";
			$this->DriverMobile->HrefValue = "";
			$this->DriverMobile->TooltipValue = "";

			// InvoiceNo
			$this->InvoiceNo->LinkCustomAttributes = "";
			$this->InvoiceNo->HrefValue = "";
			$this->InvoiceNo->TooltipValue = "";

			// InvoiceDate
			$this->InvoiceDate->LinkCustomAttributes = "";
			$this->InvoiceDate->HrefValue = "";
			$this->InvoiceDate->TooltipValue = "";

			// CreateUser
			$this->CreateUser->LinkCustomAttributes = "";
			$this->CreateUser->HrefValue = "";
			$this->CreateUser->TooltipValue = "";

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";
			$this->CreateDate->TooltipValue = "";

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

			// Id_Type
			$this->Id_Type->LinkCustomAttributes = "";
			$this->Id_Type->HrefValue = "";
			$this->Id_Type->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// RouteName
			$this->RouteName->EditAttrs["class"] = "form-control";
			$this->RouteName->EditCustomAttributes = "";
			$this->RouteName->EditValue = $this->RouteName->options(TRUE);

			// TruckNo
			$this->TruckNo->EditAttrs["class"] = "form-control";
			$this->TruckNo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->TruckNo->CurrentValue = HtmlDecode($this->TruckNo->CurrentValue);
			$this->TruckNo->EditValue = HtmlEncode($this->TruckNo->CurrentValue);
			$this->TruckNo->PlaceHolder = RemoveHtml($this->TruckNo->caption());

			// DriverName
			$this->DriverName->EditAttrs["class"] = "form-control";
			$this->DriverName->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->DriverName->CurrentValue = HtmlDecode($this->DriverName->CurrentValue);
			$this->DriverName->EditValue = HtmlEncode($this->DriverName->CurrentValue);
			$this->DriverName->PlaceHolder = RemoveHtml($this->DriverName->caption());

			// DriverMobile
			$this->DriverMobile->EditAttrs["class"] = "form-control";
			$this->DriverMobile->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->DriverMobile->CurrentValue = HtmlDecode($this->DriverMobile->CurrentValue);
			$this->DriverMobile->EditValue = HtmlEncode($this->DriverMobile->CurrentValue);
			$this->DriverMobile->PlaceHolder = RemoveHtml($this->DriverMobile->caption());

			// InvoiceNo
			$this->InvoiceNo->EditAttrs["class"] = "form-control";
			$this->InvoiceNo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->InvoiceNo->CurrentValue = HtmlDecode($this->InvoiceNo->CurrentValue);
			$this->InvoiceNo->EditValue = HtmlEncode($this->InvoiceNo->CurrentValue);
			$this->InvoiceNo->PlaceHolder = RemoveHtml($this->InvoiceNo->caption());

			// InvoiceDate
			$this->InvoiceDate->EditAttrs["class"] = "form-control";
			$this->InvoiceDate->EditCustomAttributes = "";
			$this->InvoiceDate->EditValue = HtmlEncode(FormatDateTime($this->InvoiceDate->CurrentValue, 7));
			$this->InvoiceDate->PlaceHolder = RemoveHtml($this->InvoiceDate->caption());

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

			// AttachFile
			$this->AttachFile->EditAttrs["class"] = "form-control";
			$this->AttachFile->EditCustomAttributes = "";
			if (!EmptyValue($this->AttachFile->Upload->DbValue)) {
				$this->AttachFile->EditValue = $this->AttachFile->Upload->DbValue;
			} else {
				$this->AttachFile->EditValue = "";
			}
			if (!EmptyValue($this->AttachFile->CurrentValue))
					$this->AttachFile->Upload->FileName = $this->AttachFile->CurrentValue;
			if (($this->isShow() || $this->isCopy()) && !$this->EventCancelled)
				RenderUploadField($this->AttachFile);

			// LoadingID
			$this->LoadingID->EditAttrs["class"] = "form-control";
			$this->LoadingID->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->LoadingID->CurrentValue = HtmlDecode($this->LoadingID->CurrentValue);
			$this->LoadingID->EditValue = HtmlEncode($this->LoadingID->CurrentValue);
			$this->LoadingID->PlaceHolder = RemoveHtml($this->LoadingID->caption());

			// Id_Type
			$this->Id_Type->EditAttrs["class"] = "form-control";
			$this->Id_Type->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Id_Type->CurrentValue = HtmlDecode($this->Id_Type->CurrentValue);
			$this->Id_Type->EditValue = HtmlEncode($this->Id_Type->CurrentValue);
			$this->Id_Type->PlaceHolder = RemoveHtml($this->Id_Type->caption());

			// Add refer script
			// RouteName

			$this->RouteName->LinkCustomAttributes = "";
			$this->RouteName->HrefValue = "";

			// TruckNo
			$this->TruckNo->LinkCustomAttributes = "";
			$this->TruckNo->HrefValue = "";

			// DriverName
			$this->DriverName->LinkCustomAttributes = "";
			$this->DriverName->HrefValue = "";

			// DriverMobile
			$this->DriverMobile->LinkCustomAttributes = "";
			$this->DriverMobile->HrefValue = "";

			// InvoiceNo
			$this->InvoiceNo->LinkCustomAttributes = "";
			$this->InvoiceNo->HrefValue = "";

			// InvoiceDate
			$this->InvoiceDate->LinkCustomAttributes = "";
			$this->InvoiceDate->HrefValue = "";

			// CreateUser
			$this->CreateUser->LinkCustomAttributes = "";
			$this->CreateUser->HrefValue = "";

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";

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

			// LoadingID
			$this->LoadingID->LinkCustomAttributes = "";
			$this->LoadingID->HrefValue = "";

			// Id_Type
			$this->Id_Type->LinkCustomAttributes = "";
			$this->Id_Type->HrefValue = "";
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
		if ($this->ID_Route->Required) {
			if (!$this->ID_Route->IsDetailKey && $this->ID_Route->FormValue != NULL && $this->ID_Route->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Route->caption(), $this->ID_Route->RequiredErrorMessage));
			}
		}
		if ($this->RouteName->Required) {
			if (!$this->RouteName->IsDetailKey && $this->RouteName->FormValue != NULL && $this->RouteName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RouteName->caption(), $this->RouteName->RequiredErrorMessage));
			}
		}
		if ($this->TruckNo->Required) {
			if (!$this->TruckNo->IsDetailKey && $this->TruckNo->FormValue != NULL && $this->TruckNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TruckNo->caption(), $this->TruckNo->RequiredErrorMessage));
			}
		}
		if ($this->DriverName->Required) {
			if (!$this->DriverName->IsDetailKey && $this->DriverName->FormValue != NULL && $this->DriverName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DriverName->caption(), $this->DriverName->RequiredErrorMessage));
			}
		}
		if ($this->DriverMobile->Required) {
			if (!$this->DriverMobile->IsDetailKey && $this->DriverMobile->FormValue != NULL && $this->DriverMobile->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DriverMobile->caption(), $this->DriverMobile->RequiredErrorMessage));
			}
		}
		if ($this->InvoiceNo->Required) {
			if (!$this->InvoiceNo->IsDetailKey && $this->InvoiceNo->FormValue != NULL && $this->InvoiceNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->InvoiceNo->caption(), $this->InvoiceNo->RequiredErrorMessage));
			}
		}
		if ($this->InvoiceDate->Required) {
			if (!$this->InvoiceDate->IsDetailKey && $this->InvoiceDate->FormValue != NULL && $this->InvoiceDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->InvoiceDate->caption(), $this->InvoiceDate->RequiredErrorMessage));
			}
		}
		if (!CheckEuroDate($this->InvoiceDate->FormValue)) {
			AddMessage($FormError, $this->InvoiceDate->errorMessage());
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
		if ($this->InOrOut->Required) {
			if (!$this->InOrOut->IsDetailKey && $this->InOrOut->FormValue != NULL && $this->InOrOut->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->InOrOut->caption(), $this->InOrOut->RequiredErrorMessage));
			}
		}
		if ($this->FinishUnload->Required) {
			if (!$this->FinishUnload->IsDetailKey && $this->FinishUnload->FormValue != NULL && $this->FinishUnload->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FinishUnload->caption(), $this->FinishUnload->RequiredErrorMessage));
			}
		}
		if ($this->SealNo->Required) {
			if (!$this->SealNo->IsDetailKey && $this->SealNo->FormValue != NULL && $this->SealNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SealNo->caption(), $this->SealNo->RequiredErrorMessage));
			}
		}
		if ($this->DepartureTime->Required) {
			if (!$this->DepartureTime->IsDetailKey && $this->DepartureTime->FormValue != NULL && $this->DepartureTime->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DepartureTime->caption(), $this->DepartureTime->RequiredErrorMessage));
			}
		}
		if ($this->FinishLoading->Required) {
			if (!$this->FinishLoading->IsDetailKey && $this->FinishLoading->FormValue != NULL && $this->FinishLoading->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FinishLoading->caption(), $this->FinishLoading->RequiredErrorMessage));
			}
		}
		if ($this->AttachFile->Required) {
			if ($this->AttachFile->Upload->FileName == "" && !$this->AttachFile->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->AttachFile->caption(), $this->AttachFile->RequiredErrorMessage));
			}
		}
		if ($this->LoadingID->Required) {
			if (!$this->LoadingID->IsDetailKey && $this->LoadingID->FormValue != NULL && $this->LoadingID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LoadingID->caption(), $this->LoadingID->RequiredErrorMessage));
			}
		}
		if ($this->Id_Type->Required) {
			if (!$this->Id_Type->IsDetailKey && $this->Id_Type->FormValue != NULL && $this->Id_Type->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Id_Type->caption(), $this->Id_Type->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("vwRouteUnload", $detailTblVar) && $GLOBALS["vwRouteUnload"]->DetailAdd) {
			if (!isset($GLOBALS["vwRouteUnload_grid"]))
				$GLOBALS["vwRouteUnload_grid"] = new vwRouteUnload_grid(); // Get detail page object
			$GLOBALS["vwRouteUnload_grid"]->validateGridForm();
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

		// Begin transaction
		if ($this->getCurrentDetailTable() <> "")
			$conn->beginTrans();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// RouteName
		$this->RouteName->setDbValueDef($rsnew, $this->RouteName->CurrentValue, NULL, FALSE);

		// TruckNo
		$this->TruckNo->setDbValueDef($rsnew, $this->TruckNo->CurrentValue, NULL, FALSE);

		// DriverName
		$this->DriverName->setDbValueDef($rsnew, $this->DriverName->CurrentValue, NULL, FALSE);

		// DriverMobile
		$this->DriverMobile->setDbValueDef($rsnew, $this->DriverMobile->CurrentValue, NULL, FALSE);

		// InvoiceNo
		$this->InvoiceNo->setDbValueDef($rsnew, $this->InvoiceNo->CurrentValue, NULL, FALSE);

		// InvoiceDate
		$this->InvoiceDate->setDbValueDef($rsnew, UnFormatDateTime($this->InvoiceDate->CurrentValue, 7), NULL, FALSE);

		// CreateUser
		$this->CreateUser->setDbValueDef($rsnew, $this->CreateUser->CurrentValue, NULL, FALSE);

		// CreateDate
		$this->CreateDate->setDbValueDef($rsnew, UnFormatDateTime($this->CreateDate->CurrentValue, 11), NULL, FALSE);

		// AttachFile
		if ($this->AttachFile->Visible && !$this->AttachFile->Upload->KeepFile) {
			$this->AttachFile->Upload->DbValue = ""; // No need to delete old file
			if ($this->AttachFile->Upload->FileName == "") {
				$rsnew['AttachFile'] = NULL;
			} else {
				$rsnew['AttachFile'] = $this->AttachFile->Upload->FileName;
			}
		}

		// LoadingID
		$this->LoadingID->setDbValueDef($rsnew, $this->LoadingID->CurrentValue, NULL, FALSE);

		// Id_Type
		$this->Id_Type->setDbValueDef($rsnew, $this->Id_Type->CurrentValue, NULL, FALSE);
		if ($this->AttachFile->Visible && !$this->AttachFile->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->AttachFile->Upload->DbValue) ? array() : array($this->AttachFile->Upload->DbValue);
			if (!EmptyValue($this->AttachFile->Upload->FileName)) {
				$newFiles = array($this->AttachFile->Upload->FileName);
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] <> "") {
						$file = $newFiles[$i];
						if (file_exists(UploadTempPath($this->AttachFile, $this->AttachFile->Upload->Index) . $file)) {
							if (DELETE_UPLOADED_FILES) {
								$oldFileFound = FALSE;
								$oldFileCount = count($oldFiles);
								for ($j = 0; $j < $oldFileCount; $j++) {
									$oldFile = $oldFiles[$j];
									if ($oldFile == $file) { // Old file found, no need to delete anymore
										unset($oldFiles[$j]);
										$oldFileFound = TRUE;
										break;
									}
								}
								if ($oldFileFound) // No need to check if file exists further
									continue;
							}
							$file1 = UniqueFilename($this->AttachFile->physicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(UploadTempPath($this->AttachFile, $this->AttachFile->Upload->Index) . $file1) || file_exists($this->AttachFile->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->AttachFile->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(UploadTempPath($this->AttachFile, $this->AttachFile->Upload->Index) . $file, UploadTempPath($this->AttachFile, $this->AttachFile->Upload->Index) . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->AttachFile->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
				$this->AttachFile->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
				$this->AttachFile->setDbValueDef($rsnew, $this->AttachFile->Upload->FileName, NULL, FALSE);
			}
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($addRow) {
				if ($this->AttachFile->Visible && !$this->AttachFile->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->AttachFile->Upload->DbValue) ? array() : array($this->AttachFile->Upload->DbValue);
					if (!EmptyValue($this->AttachFile->Upload->FileName)) {
						$newFiles = array($this->AttachFile->Upload->FileName);
						$newFiles2 = array($rsnew['AttachFile']);
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] <> "") {
								$file = UploadTempPath($this->AttachFile, $this->AttachFile->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] <> "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->AttachFile->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$newFiles = array();
					}
					if (DELETE_UPLOADED_FILES) {
						foreach ($oldFiles as $oldFile) {
							if ($oldFile <> "" && !in_array($oldFile, $newFiles))
								@unlink($this->AttachFile->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
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

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("vwRouteUnload", $detailTblVar) && $GLOBALS["vwRouteUnload"]->DetailAdd) {
				$GLOBALS["vwRouteUnload"]->ID_Route->setSessionValue($this->ID_Route->CurrentValue); // Set master key
				if (!isset($GLOBALS["vwRouteUnload_grid"]))
					$GLOBALS["vwRouteUnload_grid"] = new vwRouteUnload_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "vwRouteUnload"); // Load user level of detail table
				$addRow = $GLOBALS["vwRouteUnload_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow)
					$GLOBALS["vwRouteUnload"]->ID_Route->setSessionValue(""); // Clear master key if insert failed
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() <> "") {
			if ($addRow) {
				$conn->commitTrans(); // Commit transaction
			} else {
				$conn->rollbackTrans(); // Rollback transaction
			}
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// AttachFile
		if ($this->AttachFile->Upload->FileToken <> "")
			CleanUploadTempPath($this->AttachFile->Upload->FileToken, $this->AttachFile->Upload->Index);
		else
			CleanUploadTempPath($this->AttachFile, $this->AttachFile->Upload->Index);

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		if (Get(TABLE_SHOW_DETAIL) !== NULL) {
			$detailTblVar = Get(TABLE_SHOW_DETAIL);
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar <> "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("vwRouteUnload", $detailTblVar)) {
				if (!isset($GLOBALS["vwRouteUnload_grid"]))
					$GLOBALS["vwRouteUnload_grid"] = new vwRouteUnload_grid();
				if ($GLOBALS["vwRouteUnload_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["vwRouteUnload_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["vwRouteUnload_grid"]->CurrentMode = "add";
					$GLOBALS["vwRouteUnload_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["vwRouteUnload_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["vwRouteUnload_grid"]->setStartRecordNumber(1);
					$GLOBALS["vwRouteUnload_grid"]->ID_Route->IsDetailKey = TRUE;
					$GLOBALS["vwRouteUnload_grid"]->ID_Route->CurrentValue = $this->ID_Route->CurrentValue;
					$GLOBALS["vwRouteUnload_grid"]->ID_Route->setSessionValue($GLOBALS["vwRouteUnload_grid"]->ID_Route->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tbl_routelist.php"), "", $this->TableVar, TRUE);
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