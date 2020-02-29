<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Page class
 */
class tbl_route_edit extends tbl_route
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{004E2122-9CCA-46AA-835C-0778C5A080BC}";

	// Table name
	public $TableName = 'tbl_route';

	// Page object name
	public $PageObjName = "tbl_route_edit";

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
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

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
		$this->InvoiceNo->Visible = FALSE;
		$this->InvoiceDate->Visible = FALSE;
		$this->CreateUser->Visible = FALSE;
		$this->CreateDate->Visible = FALSE;
		$this->UpdateUser->Visible = FALSE;
		$this->UpdateDate->Visible = FALSE;
		$this->InOrOut->Visible = FALSE;
		$this->FinishUnload->setVisibility();
		$this->SealNo->setVisibility();
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
			if ($CurrentForm->hasValue("x_ID_Route")) {
				$this->ID_Route->setFormValue($CurrentForm->getValue("x_ID_Route"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("ID_Route") !== NULL) {
				$this->ID_Route->setQueryStringValue(Get("ID_Route"));
				$loadByQuery = TRUE;
			} else {
				$this->ID_Route->CurrentValue = NULL;
			}
		}

		// Load current record
		$loaded = $this->loadRow();

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values

			// Set up detail parameters
			$this->setupDetailParms();
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
					$this->terminate("tbl_routelist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "update": // Update
				if ($this->getCurrentDetailTable() <> "") // Master/detail edit
					$returnUrl = $this->getViewUrl(TABLE_SHOW_DETAIL . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "tbl_routelist.php")
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

					// Set up detail parameters
					$this->setupDetailParms();
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
		$this->AttachFile->Upload->Index = $CurrentForm->Index;
		$this->AttachFile->Upload->uploadFile();
		$this->AttachFile->CurrentValue = $this->AttachFile->Upload->FileName;
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

		// Check field name 'FinishUnload' first before field var 'x_FinishUnload'
		$val = $CurrentForm->hasValue("FinishUnload") ? $CurrentForm->getValue("FinishUnload") : $CurrentForm->getValue("x_FinishUnload");
		if (!$this->FinishUnload->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->FinishUnload->Visible = FALSE; // Disable update for API request
			else
				$this->FinishUnload->setFormValue($val);
		}

		// Check field name 'SealNo' first before field var 'x_SealNo'
		$val = $CurrentForm->hasValue("SealNo") ? $CurrentForm->getValue("SealNo") : $CurrentForm->getValue("x_SealNo");
		if (!$this->SealNo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->SealNo->Visible = FALSE; // Disable update for API request
			else
				$this->SealNo->setFormValue($val);
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
		if (!$this->ID_Route->IsDetailKey)
			$this->ID_Route->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ID_Route->CurrentValue = $this->ID_Route->FormValue;
		$this->RouteName->CurrentValue = $this->RouteName->FormValue;
		$this->TruckNo->CurrentValue = $this->TruckNo->FormValue;
		$this->DriverName->CurrentValue = $this->DriverName->FormValue;
		$this->DriverMobile->CurrentValue = $this->DriverMobile->FormValue;
		$this->FinishUnload->CurrentValue = $this->FinishUnload->FormValue;
		$this->SealNo->CurrentValue = $this->SealNo->FormValue;
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
		$row = [];
		$row['ID_Route'] = NULL;
		$row['RouteName'] = NULL;
		$row['TruckNo'] = NULL;
		$row['DriverName'] = NULL;
		$row['DriverMobile'] = NULL;
		$row['InvoiceNo'] = NULL;
		$row['InvoiceDate'] = NULL;
		$row['CreateUser'] = NULL;
		$row['CreateDate'] = NULL;
		$row['UpdateUser'] = NULL;
		$row['UpdateDate'] = NULL;
		$row['InOrOut'] = NULL;
		$row['FinishUnload'] = NULL;
		$row['SealNo'] = NULL;
		$row['DepartureTime'] = NULL;
		$row['FinishLoading'] = NULL;
		$row['AttachFile'] = NULL;
		$row['LoadingID'] = NULL;
		$row['Id_Type'] = NULL;
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

			// FinishUnload
			$this->FinishUnload->LinkCustomAttributes = "";
			$this->FinishUnload->HrefValue = "";
			$this->FinishUnload->TooltipValue = "";

			// SealNo
			$this->SealNo->LinkCustomAttributes = "";
			$this->SealNo->HrefValue = "";
			$this->SealNo->TooltipValue = "";

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
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

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

			// FinishUnload
			$this->FinishUnload->EditAttrs["class"] = "form-control";
			$this->FinishUnload->EditCustomAttributes = "";
			$this->FinishUnload->EditValue = $this->FinishUnload->options(TRUE);

			// SealNo
			$this->SealNo->EditAttrs["class"] = "form-control";
			$this->SealNo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->SealNo->CurrentValue = HtmlDecode($this->SealNo->CurrentValue);
			$this->SealNo->EditValue = HtmlEncode($this->SealNo->CurrentValue);
			$this->SealNo->PlaceHolder = RemoveHtml($this->SealNo->caption());

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
			if ($this->isShow() && !$this->EventCancelled)
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

			// Edit refer script
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

			// FinishUnload
			$this->FinishUnload->LinkCustomAttributes = "";
			$this->FinishUnload->HrefValue = "";

			// SealNo
			$this->SealNo->LinkCustomAttributes = "";
			$this->SealNo->HrefValue = "";

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
		if (in_array("vwRouteUnload", $detailTblVar) && $GLOBALS["vwRouteUnload"]->DetailEdit) {
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

			// Begin transaction
			if ($this->getCurrentDetailTable() <> "")
				$conn->beginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// RouteName
			$this->RouteName->setDbValueDef($rsnew, $this->RouteName->CurrentValue, NULL, $this->RouteName->ReadOnly);

			// TruckNo
			$this->TruckNo->setDbValueDef($rsnew, $this->TruckNo->CurrentValue, NULL, $this->TruckNo->ReadOnly);

			// DriverName
			$this->DriverName->setDbValueDef($rsnew, $this->DriverName->CurrentValue, NULL, $this->DriverName->ReadOnly);

			// DriverMobile
			$this->DriverMobile->setDbValueDef($rsnew, $this->DriverMobile->CurrentValue, NULL, $this->DriverMobile->ReadOnly);

			// FinishUnload
			$this->FinishUnload->setDbValueDef($rsnew, $this->FinishUnload->CurrentValue, NULL, $this->FinishUnload->ReadOnly);

			// SealNo
			$this->SealNo->setDbValueDef($rsnew, $this->SealNo->CurrentValue, NULL, $this->SealNo->ReadOnly);

			// AttachFile
			if ($this->AttachFile->Visible && !$this->AttachFile->ReadOnly && !$this->AttachFile->Upload->KeepFile) {
				$this->AttachFile->Upload->DbValue = $rsold['AttachFile']; // Get original value
				if ($this->AttachFile->Upload->FileName == "") {
					$rsnew['AttachFile'] = NULL;
				} else {
					$rsnew['AttachFile'] = $this->AttachFile->Upload->FileName;
				}
			}

			// LoadingID
			$this->LoadingID->setDbValueDef($rsnew, $this->LoadingID->CurrentValue, NULL, $this->LoadingID->ReadOnly);

			// Id_Type
			$this->Id_Type->setDbValueDef($rsnew, $this->Id_Type->CurrentValue, NULL, $this->Id_Type->ReadOnly);
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
					$this->AttachFile->setDbValueDef($rsnew, $this->AttachFile->Upload->FileName, NULL, $this->AttachFile->ReadOnly);
				}
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

				// Update detail records
				$detailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($editRow) {
					if (in_array("vwRouteUnload", $detailTblVar) && $GLOBALS["vwRouteUnload"]->DetailEdit) {
						if (!isset($GLOBALS["vwRouteUnload_grid"]))
							$GLOBALS["vwRouteUnload_grid"] = new vwRouteUnload_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "vwRouteUnload"); // Load user level of detail table
						$editRow = $GLOBALS["vwRouteUnload_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() <> "") {
					if ($editRow) {
						$conn->commitTrans(); // Commit transaction
					} else {
						$conn->rollbackTrans(); // Rollback transaction
					}
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

		// AttachFile
		if ($this->AttachFile->Upload->FileToken <> "")
			CleanUploadTempPath($this->AttachFile->Upload->FileToken, $this->AttachFile->Upload->Index);
		else
			CleanUploadTempPath($this->AttachFile, $this->AttachFile->Upload->Index);

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
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
				if ($GLOBALS["vwRouteUnload_grid"]->DetailEdit) {
					$GLOBALS["vwRouteUnload_grid"]->CurrentMode = "edit";
					$GLOBALS["vwRouteUnload_grid"]->CurrentAction = "gridedit";

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