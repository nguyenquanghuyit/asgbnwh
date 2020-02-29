<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Page class
 */
class tbl_pallet_edit extends tbl_pallet
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{004E2122-9CCA-46AA-835C-0778C5A080BC}";

	// Table name
	public $TableName = 'tbl_pallet';

	// Page object name
	public $PageObjName = "tbl_pallet_edit";

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

		// Table object (tbl_pallet)
		if (!isset($GLOBALS["tbl_pallet"]) || get_class($GLOBALS["tbl_pallet"]) == PROJECT_NAMESPACE . "tbl_pallet") {
			$GLOBALS["tbl_pallet"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_pallet"];
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
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_pallet');

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
		global $EXPORT, $tbl_pallet;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_pallet);
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
					if ($pageName == "tbl_palletview.php")
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
			$key .= @$ar['ID'];
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
			$this->ID->Visible = FALSE;
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
					$this->terminate(GetUrl("tbl_palletlist.php"));
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
		$this->ID->Visible = FALSE;
		$this->ID_Route->setVisibility();
		$this->PalletID->setVisibility();
		$this->Code->setVisibility();
		$this->Id_Type->setVisibility();
		$this->PCS->setVisibility();
		$this->ExistStatus->setVisibility();
		$this->UserCreate->Visible = FALSE;
		$this->DateTimeCreate->Visible = FALSE;
		$this->CreateUser->setVisibility();
		$this->CreateDate->setVisibility();
		$this->PenddingStatus->setVisibility();
		$this->UserFinishPendding->setVisibility();
		$this->DateTimeFinishPedding->setVisibility();
		$this->UpdateUser->Visible = FALSE;
		$this->UpdateDate->Visible = FALSE;
		$this->Status->Visible = FALSE;
		$this->ID_Code->Visible = FALSE;
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
		$this->setupLookupOptions($this->ID_Route);
		$this->setupLookupOptions($this->Code);
		$this->setupLookupOptions($this->Id_Type);

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
			if ($CurrentForm->hasValue("x_ID")) {
				$this->ID->setFormValue($CurrentForm->getValue("x_ID"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("ID") !== NULL) {
				$this->ID->setQueryStringValue(Get("ID"));
				$loadByQuery = TRUE;
			} else {
				$this->ID->CurrentValue = NULL;
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
					$this->terminate("tbl_palletlist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "tbl_palletlist.php")
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

		// Check field name 'ID_Route' first before field var 'x_ID_Route'
		$val = $CurrentForm->hasValue("ID_Route") ? $CurrentForm->getValue("ID_Route") : $CurrentForm->getValue("x_ID_Route");
		if (!$this->ID_Route->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Route->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Route->setFormValue($val);
		}

		// Check field name 'PalletID' first before field var 'x_PalletID'
		$val = $CurrentForm->hasValue("PalletID") ? $CurrentForm->getValue("PalletID") : $CurrentForm->getValue("x_PalletID");
		if (!$this->PalletID->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PalletID->Visible = FALSE; // Disable update for API request
			else
				$this->PalletID->setFormValue($val);
		}

		// Check field name 'Code' first before field var 'x_Code'
		$val = $CurrentForm->hasValue("Code") ? $CurrentForm->getValue("Code") : $CurrentForm->getValue("x_Code");
		if (!$this->Code->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Code->Visible = FALSE; // Disable update for API request
			else
				$this->Code->setFormValue($val);
		}

		// Check field name 'Id_Type' first before field var 'x_Id_Type'
		$val = $CurrentForm->hasValue("Id_Type") ? $CurrentForm->getValue("Id_Type") : $CurrentForm->getValue("x_Id_Type");
		if (!$this->Id_Type->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Id_Type->Visible = FALSE; // Disable update for API request
			else
				$this->Id_Type->setFormValue($val);
		}

		// Check field name 'PCS' first before field var 'x_PCS'
		$val = $CurrentForm->hasValue("PCS") ? $CurrentForm->getValue("PCS") : $CurrentForm->getValue("x_PCS");
		if (!$this->PCS->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PCS->Visible = FALSE; // Disable update for API request
			else
				$this->PCS->setFormValue($val);
		}

		// Check field name 'ExistStatus' first before field var 'x_ExistStatus'
		$val = $CurrentForm->hasValue("ExistStatus") ? $CurrentForm->getValue("ExistStatus") : $CurrentForm->getValue("x_ExistStatus");
		if (!$this->ExistStatus->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ExistStatus->Visible = FALSE; // Disable update for API request
			else
				$this->ExistStatus->setFormValue($val);
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

		// Check field name 'PenddingStatus' first before field var 'x_PenddingStatus'
		$val = $CurrentForm->hasValue("PenddingStatus") ? $CurrentForm->getValue("PenddingStatus") : $CurrentForm->getValue("x_PenddingStatus");
		if (!$this->PenddingStatus->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PenddingStatus->Visible = FALSE; // Disable update for API request
			else
				$this->PenddingStatus->setFormValue($val);
		}

		// Check field name 'UserFinishPendding' first before field var 'x_UserFinishPendding'
		$val = $CurrentForm->hasValue("UserFinishPendding") ? $CurrentForm->getValue("UserFinishPendding") : $CurrentForm->getValue("x_UserFinishPendding");
		if (!$this->UserFinishPendding->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->UserFinishPendding->Visible = FALSE; // Disable update for API request
			else
				$this->UserFinishPendding->setFormValue($val);
		}

		// Check field name 'DateTimeFinishPedding' first before field var 'x_DateTimeFinishPedding'
		$val = $CurrentForm->hasValue("DateTimeFinishPedding") ? $CurrentForm->getValue("DateTimeFinishPedding") : $CurrentForm->getValue("x_DateTimeFinishPedding");
		if (!$this->DateTimeFinishPedding->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DateTimeFinishPedding->Visible = FALSE; // Disable update for API request
			else
				$this->DateTimeFinishPedding->setFormValue($val);
			$this->DateTimeFinishPedding->CurrentValue = UnFormatDateTime($this->DateTimeFinishPedding->CurrentValue, 11);
		}

		// Check field name 'ID' first before field var 'x_ID'
		$val = $CurrentForm->hasValue("ID") ? $CurrentForm->getValue("ID") : $CurrentForm->getValue("x_ID");
		if (!$this->ID->IsDetailKey)
			$this->ID->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ID->CurrentValue = $this->ID->FormValue;
		$this->ID_Route->CurrentValue = $this->ID_Route->FormValue;
		$this->PalletID->CurrentValue = $this->PalletID->FormValue;
		$this->Code->CurrentValue = $this->Code->FormValue;
		$this->Id_Type->CurrentValue = $this->Id_Type->FormValue;
		$this->PCS->CurrentValue = $this->PCS->FormValue;
		$this->ExistStatus->CurrentValue = $this->ExistStatus->FormValue;
		$this->CreateUser->CurrentValue = $this->CreateUser->FormValue;
		$this->CreateDate->CurrentValue = $this->CreateDate->FormValue;
		$this->CreateDate->CurrentValue = UnFormatDateTime($this->CreateDate->CurrentValue, 11);
		$this->PenddingStatus->CurrentValue = $this->PenddingStatus->FormValue;
		$this->UserFinishPendding->CurrentValue = $this->UserFinishPendding->FormValue;
		$this->DateTimeFinishPedding->CurrentValue = $this->DateTimeFinishPedding->FormValue;
		$this->DateTimeFinishPedding->CurrentValue = UnFormatDateTime($this->DateTimeFinishPedding->CurrentValue, 11);
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
		$this->ID->setDbValue($row['ID']);
		$this->ID_Route->setDbValue($row['ID_Route']);
		if (array_key_exists('EV__ID_Route', $rs->fields)) {
			$this->ID_Route->VirtualValue = $rs->fields('EV__ID_Route'); // Set up virtual field value
		} else {
			$this->ID_Route->VirtualValue = ""; // Clear value
		}
		$this->PalletID->setDbValue($row['PalletID']);
		$this->Code->setDbValue($row['Code']);
		if (array_key_exists('EV__Code', $rs->fields)) {
			$this->Code->VirtualValue = $rs->fields('EV__Code'); // Set up virtual field value
		} else {
			$this->Code->VirtualValue = ""; // Clear value
		}
		$this->Id_Type->setDbValue($row['Id_Type']);
		$this->PCS->setDbValue($row['PCS']);
		$this->ExistStatus->setDbValue($row['ExistStatus']);
		$this->UserCreate->setDbValue($row['UserCreate']);
		$this->DateTimeCreate->setDbValue($row['DateTimeCreate']);
		$this->CreateUser->setDbValue($row['CreateUser']);
		$this->CreateDate->setDbValue($row['CreateDate']);
		$this->PenddingStatus->setDbValue($row['PenddingStatus']);
		$this->UserFinishPendding->setDbValue($row['UserFinishPendding']);
		$this->DateTimeFinishPedding->setDbValue($row['DateTimeFinishPedding']);
		$this->UpdateUser->setDbValue($row['UpdateUser']);
		$this->UpdateDate->setDbValue($row['UpdateDate']);
		$this->Status->setDbValue($row['Status']);
		$this->ID_Code->setDbValue($row['ID_Code']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['ID'] = NULL;
		$row['ID_Route'] = NULL;
		$row['PalletID'] = NULL;
		$row['Code'] = NULL;
		$row['Id_Type'] = NULL;
		$row['PCS'] = NULL;
		$row['ExistStatus'] = NULL;
		$row['UserCreate'] = NULL;
		$row['DateTimeCreate'] = NULL;
		$row['CreateUser'] = NULL;
		$row['CreateDate'] = NULL;
		$row['PenddingStatus'] = NULL;
		$row['UserFinishPendding'] = NULL;
		$row['DateTimeFinishPedding'] = NULL;
		$row['UpdateUser'] = NULL;
		$row['UpdateDate'] = NULL;
		$row['Status'] = NULL;
		$row['ID_Code'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ID")) <> "")
			$this->ID->CurrentValue = $this->getKey("ID"); // ID
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
		// ID
		// ID_Route
		// PalletID
		// Code
		// Id_Type
		// PCS
		// ExistStatus
		// UserCreate
		// DateTimeCreate
		// CreateUser
		// CreateDate
		// PenddingStatus
		// UserFinishPendding
		// DateTimeFinishPedding
		// UpdateUser
		// UpdateDate
		// Status
		// ID_Code

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ID_Route
			if ($this->ID_Route->VirtualValue <> "") {
				$this->ID_Route->ViewValue = $this->ID_Route->VirtualValue;
			} else {
			$curVal = strval($this->ID_Route->CurrentValue);
			if ($curVal <> "") {
				$this->ID_Route->ViewValue = $this->ID_Route->lookupCacheOption($curVal);
				if ($this->ID_Route->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ID_Route`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ID_Route->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->ID_Route->ViewValue = $this->ID_Route->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ID_Route->ViewValue = $this->ID_Route->CurrentValue;
					}
				}
			} else {
				$this->ID_Route->ViewValue = NULL;
			}
			}
			$this->ID_Route->CellCssStyle .= "text-align: center;";
			$this->ID_Route->ViewCustomAttributes = "";

			// PalletID
			$this->PalletID->ViewValue = $this->PalletID->CurrentValue;
			$this->PalletID->CssClass = "font-weight-bold";
			$this->PalletID->ViewCustomAttributes = "";

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

			// Id_Type
			$curVal = strval($this->Id_Type->CurrentValue);
			if ($curVal <> "") {
				$this->Id_Type->ViewValue = $this->Id_Type->lookupCacheOption($curVal);
				if ($this->Id_Type->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`IdType`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Id_Type->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->Id_Type->ViewValue = $this->Id_Type->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Id_Type->ViewValue = $this->Id_Type->CurrentValue;
					}
				}
			} else {
				$this->Id_Type->ViewValue = NULL;
			}
			$this->Id_Type->CellCssStyle .= "text-align: center;";
			$this->Id_Type->ViewCustomAttributes = "";

			// PCS
			$this->PCS->ViewValue = $this->PCS->CurrentValue;
			$this->PCS->ViewValue = FormatNumber($this->PCS->ViewValue, 0, -2, -2, -2);
			$this->PCS->CellCssStyle .= "text-align: right;";
			$this->PCS->ViewCustomAttributes = "";

			// ExistStatus
			if (strval($this->ExistStatus->CurrentValue) <> "") {
				$this->ExistStatus->ViewValue = $this->ExistStatus->optionCaption($this->ExistStatus->CurrentValue);
			} else {
				$this->ExistStatus->ViewValue = NULL;
			}
			$this->ExistStatus->CellCssStyle .= "text-align: center;";
			$this->ExistStatus->ViewCustomAttributes = "";

			// CreateUser
			$this->CreateUser->ViewValue = $this->CreateUser->CurrentValue;
			$this->CreateUser->ViewCustomAttributes = "";

			// CreateDate
			$this->CreateDate->ViewValue = $this->CreateDate->CurrentValue;
			$this->CreateDate->ViewValue = FormatDateTime($this->CreateDate->ViewValue, 11);
			$this->CreateDate->ViewCustomAttributes = "";

			// PenddingStatus
			if (strval($this->PenddingStatus->CurrentValue) <> "") {
				$this->PenddingStatus->ViewValue = $this->PenddingStatus->optionCaption($this->PenddingStatus->CurrentValue);
			} else {
				$this->PenddingStatus->ViewValue = NULL;
			}
			$this->PenddingStatus->CellCssStyle .= "text-align: center;";
			$this->PenddingStatus->ViewCustomAttributes = "";

			// UserFinishPendding
			$this->UserFinishPendding->ViewValue = $this->UserFinishPendding->CurrentValue;
			$this->UserFinishPendding->ViewCustomAttributes = "";

			// DateTimeFinishPedding
			$this->DateTimeFinishPedding->ViewValue = $this->DateTimeFinishPedding->CurrentValue;
			$this->DateTimeFinishPedding->ViewValue = FormatDateTime($this->DateTimeFinishPedding->ViewValue, 11);
			$this->DateTimeFinishPedding->ViewCustomAttributes = "";

			// ID_Route
			$this->ID_Route->LinkCustomAttributes = "";
			$this->ID_Route->HrefValue = "";
			$this->ID_Route->TooltipValue = "";

			// PalletID
			$this->PalletID->LinkCustomAttributes = "";
			$this->PalletID->HrefValue = "";
			$this->PalletID->TooltipValue = "";

			// Code
			$this->Code->LinkCustomAttributes = "";
			$this->Code->HrefValue = "";
			$this->Code->TooltipValue = "";

			// Id_Type
			$this->Id_Type->LinkCustomAttributes = "";
			$this->Id_Type->HrefValue = "";
			$this->Id_Type->TooltipValue = "";

			// PCS
			$this->PCS->LinkCustomAttributes = "";
			$this->PCS->HrefValue = "";
			$this->PCS->TooltipValue = "";

			// ExistStatus
			$this->ExistStatus->LinkCustomAttributes = "";
			$this->ExistStatus->HrefValue = "";
			$this->ExistStatus->TooltipValue = "";

			// CreateUser
			$this->CreateUser->LinkCustomAttributes = "";
			$this->CreateUser->HrefValue = "";
			$this->CreateUser->TooltipValue = "";

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";
			$this->CreateDate->TooltipValue = "";

			// PenddingStatus
			$this->PenddingStatus->LinkCustomAttributes = "";
			$this->PenddingStatus->HrefValue = "";
			$this->PenddingStatus->TooltipValue = "";

			// UserFinishPendding
			$this->UserFinishPendding->LinkCustomAttributes = "";
			$this->UserFinishPendding->HrefValue = "";
			$this->UserFinishPendding->TooltipValue = "";

			// DateTimeFinishPedding
			$this->DateTimeFinishPedding->LinkCustomAttributes = "";
			$this->DateTimeFinishPedding->HrefValue = "";
			$this->DateTimeFinishPedding->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// ID_Route
			$this->ID_Route->EditAttrs["class"] = "form-control";
			$this->ID_Route->EditCustomAttributes = "";
			$curVal = trim(strval($this->ID_Route->CurrentValue));
			if ($curVal <> "")
				$this->ID_Route->ViewValue = $this->ID_Route->lookupCacheOption($curVal);
			else
				$this->ID_Route->ViewValue = $this->ID_Route->Lookup !== NULL && is_array($this->ID_Route->Lookup->Options) ? $curVal : NULL;
			if ($this->ID_Route->ViewValue !== NULL) { // Load from cache
				$this->ID_Route->EditValue = array_values($this->ID_Route->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ID_Route`" . SearchString("=", $this->ID_Route->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ID_Route->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->ID_Route->EditValue = $arwrk;
			}

			// PalletID
			$this->PalletID->EditAttrs["class"] = "form-control";
			$this->PalletID->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->PalletID->CurrentValue = HtmlDecode($this->PalletID->CurrentValue);
			$this->PalletID->EditValue = HtmlEncode($this->PalletID->CurrentValue);
			$this->PalletID->PlaceHolder = RemoveHtml($this->PalletID->caption());

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

			// Id_Type
			$this->Id_Type->EditAttrs["class"] = "form-control";
			$this->Id_Type->EditCustomAttributes = "";
			$curVal = trim(strval($this->Id_Type->CurrentValue));
			if ($curVal <> "")
				$this->Id_Type->ViewValue = $this->Id_Type->lookupCacheOption($curVal);
			else
				$this->Id_Type->ViewValue = $this->Id_Type->Lookup !== NULL && is_array($this->Id_Type->Lookup->Options) ? $curVal : NULL;
			if ($this->Id_Type->ViewValue !== NULL) { // Load from cache
				$this->Id_Type->EditValue = array_values($this->Id_Type->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`IdType`" . SearchString("=", $this->Id_Type->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Id_Type->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->Id_Type->EditValue = $arwrk;
			}

			// PCS
			$this->PCS->EditAttrs["class"] = "form-control";
			$this->PCS->EditCustomAttributes = "";
			$this->PCS->EditValue = HtmlEncode($this->PCS->CurrentValue);
			$this->PCS->PlaceHolder = RemoveHtml($this->PCS->caption());

			// ExistStatus
			$this->ExistStatus->EditAttrs["class"] = "form-control";
			$this->ExistStatus->EditCustomAttributes = "";
			$this->ExistStatus->EditValue = $this->ExistStatus->options(TRUE);

			// CreateUser
			// CreateDate
			// PenddingStatus

			$this->PenddingStatus->EditAttrs["class"] = "form-control";
			$this->PenddingStatus->EditCustomAttributes = "";
			$this->PenddingStatus->EditValue = $this->PenddingStatus->options(TRUE);

			// UserFinishPendding
			// DateTimeFinishPedding
			// Edit refer script
			// ID_Route

			$this->ID_Route->LinkCustomAttributes = "";
			$this->ID_Route->HrefValue = "";

			// PalletID
			$this->PalletID->LinkCustomAttributes = "";
			$this->PalletID->HrefValue = "";

			// Code
			$this->Code->LinkCustomAttributes = "";
			$this->Code->HrefValue = "";

			// Id_Type
			$this->Id_Type->LinkCustomAttributes = "";
			$this->Id_Type->HrefValue = "";

			// PCS
			$this->PCS->LinkCustomAttributes = "";
			$this->PCS->HrefValue = "";

			// ExistStatus
			$this->ExistStatus->LinkCustomAttributes = "";
			$this->ExistStatus->HrefValue = "";

			// CreateUser
			$this->CreateUser->LinkCustomAttributes = "";
			$this->CreateUser->HrefValue = "";

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";

			// PenddingStatus
			$this->PenddingStatus->LinkCustomAttributes = "";
			$this->PenddingStatus->HrefValue = "";

			// UserFinishPendding
			$this->UserFinishPendding->LinkCustomAttributes = "";
			$this->UserFinishPendding->HrefValue = "";

			// DateTimeFinishPedding
			$this->DateTimeFinishPedding->LinkCustomAttributes = "";
			$this->DateTimeFinishPedding->HrefValue = "";
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
		if ($this->ID->Required) {
			if (!$this->ID->IsDetailKey && $this->ID->FormValue != NULL && $this->ID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID->caption(), $this->ID->RequiredErrorMessage));
			}
		}
		if ($this->ID_Route->Required) {
			if (!$this->ID_Route->IsDetailKey && $this->ID_Route->FormValue != NULL && $this->ID_Route->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Route->caption(), $this->ID_Route->RequiredErrorMessage));
			}
		}
		if ($this->PalletID->Required) {
			if (!$this->PalletID->IsDetailKey && $this->PalletID->FormValue != NULL && $this->PalletID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PalletID->caption(), $this->PalletID->RequiredErrorMessage));
			}
		}
		if ($this->Code->Required) {
			if (!$this->Code->IsDetailKey && $this->Code->FormValue != NULL && $this->Code->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Code->caption(), $this->Code->RequiredErrorMessage));
			}
		}
		if ($this->Id_Type->Required) {
			if (!$this->Id_Type->IsDetailKey && $this->Id_Type->FormValue != NULL && $this->Id_Type->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Id_Type->caption(), $this->Id_Type->RequiredErrorMessage));
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
		if ($this->ExistStatus->Required) {
			if (!$this->ExistStatus->IsDetailKey && $this->ExistStatus->FormValue != NULL && $this->ExistStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ExistStatus->caption(), $this->ExistStatus->RequiredErrorMessage));
			}
		}
		if ($this->UserCreate->Required) {
			if (!$this->UserCreate->IsDetailKey && $this->UserCreate->FormValue != NULL && $this->UserCreate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UserCreate->caption(), $this->UserCreate->RequiredErrorMessage));
			}
		}
		if ($this->DateTimeCreate->Required) {
			if (!$this->DateTimeCreate->IsDetailKey && $this->DateTimeCreate->FormValue != NULL && $this->DateTimeCreate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateTimeCreate->caption(), $this->DateTimeCreate->RequiredErrorMessage));
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
		if ($this->PenddingStatus->Required) {
			if (!$this->PenddingStatus->IsDetailKey && $this->PenddingStatus->FormValue != NULL && $this->PenddingStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PenddingStatus->caption(), $this->PenddingStatus->RequiredErrorMessage));
			}
		}
		if ($this->UserFinishPendding->Required) {
			if (!$this->UserFinishPendding->IsDetailKey && $this->UserFinishPendding->FormValue != NULL && $this->UserFinishPendding->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UserFinishPendding->caption(), $this->UserFinishPendding->RequiredErrorMessage));
			}
		}
		if ($this->DateTimeFinishPedding->Required) {
			if (!$this->DateTimeFinishPedding->IsDetailKey && $this->DateTimeFinishPedding->FormValue != NULL && $this->DateTimeFinishPedding->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateTimeFinishPedding->caption(), $this->DateTimeFinishPedding->RequiredErrorMessage));
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
		if ($this->Status->Required) {
			if (!$this->Status->IsDetailKey && $this->Status->FormValue != NULL && $this->Status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Status->caption(), $this->Status->RequiredErrorMessage));
			}
		}
		if ($this->ID_Code->Required) {
			if (!$this->ID_Code->IsDetailKey && $this->ID_Code->FormValue != NULL && $this->ID_Code->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Code->caption(), $this->ID_Code->RequiredErrorMessage));
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

			// ID_Route
			$this->ID_Route->setDbValueDef($rsnew, $this->ID_Route->CurrentValue, 0, $this->ID_Route->ReadOnly);

			// PalletID
			$this->PalletID->setDbValueDef($rsnew, $this->PalletID->CurrentValue, NULL, $this->PalletID->ReadOnly);

			// Code
			$this->Code->setDbValueDef($rsnew, $this->Code->CurrentValue, "", $this->Code->ReadOnly);

			// Id_Type
			$this->Id_Type->setDbValueDef($rsnew, $this->Id_Type->CurrentValue, NULL, $this->Id_Type->ReadOnly);

			// PCS
			$this->PCS->setDbValueDef($rsnew, $this->PCS->CurrentValue, 0, $this->PCS->ReadOnly);

			// ExistStatus
			$this->ExistStatus->setDbValueDef($rsnew, $this->ExistStatus->CurrentValue, 0, $this->ExistStatus->ReadOnly);

			// CreateUser
			$this->CreateUser->setDbValueDef($rsnew, CurrentUserName(), NULL);
			$rsnew['CreateUser'] = &$this->CreateUser->DbValue;

			// CreateDate
			$this->CreateDate->setDbValueDef($rsnew, CurrentDateTime(), NULL);
			$rsnew['CreateDate'] = &$this->CreateDate->DbValue;

			// PenddingStatus
			$this->PenddingStatus->setDbValueDef($rsnew, $this->PenddingStatus->CurrentValue, 0, $this->PenddingStatus->ReadOnly);

			// UserFinishPendding
			$this->UserFinishPendding->setDbValueDef($rsnew, CurrentUserName(), NULL);
			$rsnew['UserFinishPendding'] = &$this->UserFinishPendding->DbValue;

			// DateTimeFinishPedding
			$this->DateTimeFinishPedding->setDbValueDef($rsnew, CurrentDateTime(), NULL);
			$rsnew['DateTimeFinishPedding'] = &$this->DateTimeFinishPedding->DbValue;

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tbl_palletlist.php"), "", $this->TableVar, TRUE);
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
						case "x_ID_Route":
							break;
						case "x_Code":
							break;
						case "x_Id_Type":
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