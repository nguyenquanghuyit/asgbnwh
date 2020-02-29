<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Page class
 */
class tbl_stock_add extends tbl_stock
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{004E2122-9CCA-46AA-835C-0778C5A080BC}";

	// Table name
	public $TableName = 'tbl_stock';

	// Page object name
	public $PageObjName = "tbl_stock_add";

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

		// Table object (tbl_stock)
		if (!isset($GLOBALS["tbl_stock"]) || get_class($GLOBALS["tbl_stock"]) == PROJECT_NAMESPACE . "tbl_stock") {
			$GLOBALS["tbl_stock"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_stock"];
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
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_stock');

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
		global $EXPORT, $tbl_stock;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_stock);
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
					if ($pageName == "tbl_stockview.php")
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
			$key .= @$ar['ID_Stock'];
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
			$this->ID_Stock->Visible = FALSE;
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
					$this->terminate(GetUrl("tbl_stocklist.php"));
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
		$this->ID_Stock->Visible = FALSE;
		$this->PalletID->setVisibility();
		$this->Code->setVisibility();
		$this->IdType->setVisibility();
		$this->ID_Location->setVisibility();
		$this->Pcs_RemainPicking->setVisibility();
		$this->PCS->Visible = FALSE;
		$this->MFG->setVisibility();
		$this->DateIn->Visible = FALSE;
		$this->Imp_id->Visible = FALSE;
		$this->User_ID->Visible = FALSE;
		$this->Note_PalletId->setVisibility();
		$this->CreateUser->setVisibility();
		$this->CreateDate->setVisibility();
		$this->UpdateUser->Visible = FALSE;
		$this->UpdateDate->Visible = FALSE;
		$this->StatusPicking->Visible = FALSE;
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
		$this->setupLookupOptions($this->IdType);
		$this->setupLookupOptions($this->ID_Location);

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
			if (Get("ID_Stock") !== NULL) {
				$this->ID_Stock->setQueryStringValue(Get("ID_Stock"));
				$this->setKey("ID_Stock", $this->ID_Stock->CurrentValue); // Set up key
			} else {
				$this->setKey("ID_Stock", ""); // Clear key
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
					$this->terminate("tbl_stocklist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "tbl_stocklist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "tbl_stockview.php")
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
		$this->ID_Stock->CurrentValue = NULL;
		$this->ID_Stock->OldValue = $this->ID_Stock->CurrentValue;
		$this->PalletID->CurrentValue = NULL;
		$this->PalletID->OldValue = $this->PalletID->CurrentValue;
		$this->Code->CurrentValue = NULL;
		$this->Code->OldValue = $this->Code->CurrentValue;
		$this->IdType->CurrentValue = NULL;
		$this->IdType->OldValue = $this->IdType->CurrentValue;
		$this->ID_Location->CurrentValue = NULL;
		$this->ID_Location->OldValue = $this->ID_Location->CurrentValue;
		$this->Pcs_RemainPicking->CurrentValue = NULL;
		$this->Pcs_RemainPicking->OldValue = $this->Pcs_RemainPicking->CurrentValue;
		$this->PCS->CurrentValue = NULL;
		$this->PCS->OldValue = $this->PCS->CurrentValue;
		$this->MFG->CurrentValue = NULL;
		$this->MFG->OldValue = $this->MFG->CurrentValue;
		$this->DateIn->CurrentValue = NULL;
		$this->DateIn->OldValue = $this->DateIn->CurrentValue;
		$this->Imp_id->CurrentValue = NULL;
		$this->Imp_id->OldValue = $this->Imp_id->CurrentValue;
		$this->User_ID->CurrentValue = NULL;
		$this->User_ID->OldValue = $this->User_ID->CurrentValue;
		$this->Note_PalletId->CurrentValue = NULL;
		$this->Note_PalletId->OldValue = $this->Note_PalletId->CurrentValue;
		$this->CreateUser->CurrentValue = CurrentUserName();
		$this->CreateDate->CurrentValue = CurrentDateTime();
		$this->UpdateUser->CurrentValue = NULL;
		$this->UpdateUser->OldValue = $this->UpdateUser->CurrentValue;
		$this->UpdateDate->CurrentValue = NULL;
		$this->UpdateDate->OldValue = $this->UpdateDate->CurrentValue;
		$this->StatusPicking->CurrentValue = NULL;
		$this->StatusPicking->OldValue = $this->StatusPicking->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

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

		// Check field name 'IdType' first before field var 'x_IdType'
		$val = $CurrentForm->hasValue("IdType") ? $CurrentForm->getValue("IdType") : $CurrentForm->getValue("x_IdType");
		if (!$this->IdType->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->IdType->Visible = FALSE; // Disable update for API request
			else
				$this->IdType->setFormValue($val);
		}

		// Check field name 'ID_Location' first before field var 'x_ID_Location'
		$val = $CurrentForm->hasValue("ID_Location") ? $CurrentForm->getValue("ID_Location") : $CurrentForm->getValue("x_ID_Location");
		if (!$this->ID_Location->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Location->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Location->setFormValue($val);
		}

		// Check field name 'Pcs_RemainPicking' first before field var 'x_Pcs_RemainPicking'
		$val = $CurrentForm->hasValue("Pcs_RemainPicking") ? $CurrentForm->getValue("Pcs_RemainPicking") : $CurrentForm->getValue("x_Pcs_RemainPicking");
		if (!$this->Pcs_RemainPicking->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Pcs_RemainPicking->Visible = FALSE; // Disable update for API request
			else
				$this->Pcs_RemainPicking->setFormValue($val);
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

		// Check field name 'Note_PalletId' first before field var 'x_Note_PalletId'
		$val = $CurrentForm->hasValue("Note_PalletId") ? $CurrentForm->getValue("Note_PalletId") : $CurrentForm->getValue("x_Note_PalletId");
		if (!$this->Note_PalletId->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Note_PalletId->Visible = FALSE; // Disable update for API request
			else
				$this->Note_PalletId->setFormValue($val);
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

		// Check field name 'ID_Stock' first before field var 'x_ID_Stock'
		$val = $CurrentForm->hasValue("ID_Stock") ? $CurrentForm->getValue("ID_Stock") : $CurrentForm->getValue("x_ID_Stock");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->PalletID->CurrentValue = $this->PalletID->FormValue;
		$this->Code->CurrentValue = $this->Code->FormValue;
		$this->IdType->CurrentValue = $this->IdType->FormValue;
		$this->ID_Location->CurrentValue = $this->ID_Location->FormValue;
		$this->Pcs_RemainPicking->CurrentValue = $this->Pcs_RemainPicking->FormValue;
		$this->MFG->CurrentValue = $this->MFG->FormValue;
		$this->MFG->CurrentValue = UnFormatDateTime($this->MFG->CurrentValue, 7);
		$this->Note_PalletId->CurrentValue = $this->Note_PalletId->FormValue;
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
		$this->ID_Stock->setDbValue($row['ID_Stock']);
		$this->PalletID->setDbValue($row['PalletID']);
		$this->Code->setDbValue($row['Code']);
		$this->IdType->setDbValue($row['IdType']);
		$this->ID_Location->setDbValue($row['ID_Location']);
		if (array_key_exists('EV__ID_Location', $rs->fields)) {
			$this->ID_Location->VirtualValue = $rs->fields('EV__ID_Location'); // Set up virtual field value
		} else {
			$this->ID_Location->VirtualValue = ""; // Clear value
		}
		$this->Pcs_RemainPicking->setDbValue($row['Pcs_RemainPicking']);
		$this->PCS->setDbValue($row['PCS']);
		$this->MFG->setDbValue($row['MFG']);
		$this->DateIn->setDbValue($row['DateIn']);
		$this->Imp_id->setDbValue($row['Imp_id']);
		$this->User_ID->setDbValue($row['User_ID']);
		$this->Note_PalletId->setDbValue($row['Note_PalletId']);
		$this->CreateUser->setDbValue($row['CreateUser']);
		$this->CreateDate->setDbValue($row['CreateDate']);
		$this->UpdateUser->setDbValue($row['UpdateUser']);
		$this->UpdateDate->setDbValue($row['UpdateDate']);
		$this->StatusPicking->setDbValue($row['StatusPicking']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ID_Stock'] = $this->ID_Stock->CurrentValue;
		$row['PalletID'] = $this->PalletID->CurrentValue;
		$row['Code'] = $this->Code->CurrentValue;
		$row['IdType'] = $this->IdType->CurrentValue;
		$row['ID_Location'] = $this->ID_Location->CurrentValue;
		$row['Pcs_RemainPicking'] = $this->Pcs_RemainPicking->CurrentValue;
		$row['PCS'] = $this->PCS->CurrentValue;
		$row['MFG'] = $this->MFG->CurrentValue;
		$row['DateIn'] = $this->DateIn->CurrentValue;
		$row['Imp_id'] = $this->Imp_id->CurrentValue;
		$row['User_ID'] = $this->User_ID->CurrentValue;
		$row['Note_PalletId'] = $this->Note_PalletId->CurrentValue;
		$row['CreateUser'] = $this->CreateUser->CurrentValue;
		$row['CreateDate'] = $this->CreateDate->CurrentValue;
		$row['UpdateUser'] = $this->UpdateUser->CurrentValue;
		$row['UpdateDate'] = $this->UpdateDate->CurrentValue;
		$row['StatusPicking'] = $this->StatusPicking->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ID_Stock")) <> "")
			$this->ID_Stock->CurrentValue = $this->getKey("ID_Stock"); // ID_Stock
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
		// ID_Stock
		// PalletID
		// Code
		// IdType
		// ID_Location
		// Pcs_RemainPicking
		// PCS
		// MFG
		// DateIn
		// Imp_id
		// User_ID
		// Note_PalletId
		// CreateUser
		// CreateDate
		// UpdateUser
		// UpdateDate
		// StatusPicking

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// PalletID
			$this->PalletID->ViewValue = $this->PalletID->CurrentValue;
			$this->PalletID->ViewCustomAttributes = "";

			// Code
			$this->Code->ViewValue = $this->Code->CurrentValue;
			$this->Code->CssClass = "font-weight-bold";
			$this->Code->ViewCustomAttributes = "";

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
			$this->IdType->CellCssStyle .= "text-align: center;";
			$this->IdType->ViewCustomAttributes = "";

			// ID_Location
			if ($this->ID_Location->VirtualValue <> "") {
				$this->ID_Location->ViewValue = $this->ID_Location->VirtualValue;
			} else {
				$this->ID_Location->ViewValue = $this->ID_Location->CurrentValue;
			$curVal = strval($this->ID_Location->CurrentValue);
			if ($curVal <> "") {
				$this->ID_Location->ViewValue = $this->ID_Location->lookupCacheOption($curVal);
				if ($this->ID_Location->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ID_Location`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ID_Location->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->ID_Location->ViewValue = $this->ID_Location->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ID_Location->ViewValue = $this->ID_Location->CurrentValue;
					}
				}
			} else {
				$this->ID_Location->ViewValue = NULL;
			}
			}
			$this->ID_Location->ViewCustomAttributes = "";

			// Pcs_RemainPicking
			$this->Pcs_RemainPicking->ViewValue = $this->Pcs_RemainPicking->CurrentValue;
			$this->Pcs_RemainPicking->ViewValue = FormatNumber($this->Pcs_RemainPicking->ViewValue, 0, -2, -2, -2);
			$this->Pcs_RemainPicking->CssClass = "font-weight-bold";
			$this->Pcs_RemainPicking->CellCssStyle .= "text-align: right;";
			$this->Pcs_RemainPicking->ViewCustomAttributes = "";

			// MFG
			$this->MFG->ViewValue = $this->MFG->CurrentValue;
			$this->MFG->ViewValue = FormatDateTime($this->MFG->ViewValue, 7);
			$this->MFG->CssClass = "font-weight-bold";
			$this->MFG->CellCssStyle .= "text-align: center;";
			$this->MFG->ViewCustomAttributes = "";

			// Note_PalletId
			$this->Note_PalletId->ViewValue = $this->Note_PalletId->CurrentValue;
			$this->Note_PalletId->ViewCustomAttributes = "";

			// CreateUser
			$this->CreateUser->ViewValue = $this->CreateUser->CurrentValue;
			$this->CreateUser->ViewCustomAttributes = "";

			// CreateDate
			$this->CreateDate->ViewValue = $this->CreateDate->CurrentValue;
			$this->CreateDate->ViewValue = FormatDateTime($this->CreateDate->ViewValue, 11);
			$this->CreateDate->ViewCustomAttributes = "";

			// PalletID
			$this->PalletID->LinkCustomAttributes = "";
			$this->PalletID->HrefValue = "";
			$this->PalletID->TooltipValue = "";

			// Code
			$this->Code->LinkCustomAttributes = "";
			$this->Code->HrefValue = "";
			$this->Code->TooltipValue = "";

			// IdType
			$this->IdType->LinkCustomAttributes = "";
			$this->IdType->HrefValue = "";
			$this->IdType->TooltipValue = "";

			// ID_Location
			$this->ID_Location->LinkCustomAttributes = "";
			$this->ID_Location->HrefValue = "";
			$this->ID_Location->TooltipValue = "";

			// Pcs_RemainPicking
			$this->Pcs_RemainPicking->LinkCustomAttributes = "";
			$this->Pcs_RemainPicking->HrefValue = "";
			$this->Pcs_RemainPicking->TooltipValue = "";

			// MFG
			$this->MFG->LinkCustomAttributes = "";
			$this->MFG->HrefValue = "";
			$this->MFG->TooltipValue = "";

			// Note_PalletId
			$this->Note_PalletId->LinkCustomAttributes = "";
			$this->Note_PalletId->HrefValue = "";
			$this->Note_PalletId->TooltipValue = "";

			// CreateUser
			$this->CreateUser->LinkCustomAttributes = "";
			$this->CreateUser->HrefValue = "";
			$this->CreateUser->TooltipValue = "";

			// CreateDate
			$this->CreateDate->LinkCustomAttributes = "";
			$this->CreateDate->HrefValue = "";
			$this->CreateDate->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

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
			$this->Code->PlaceHolder = RemoveHtml($this->Code->caption());

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

			// ID_Location
			$this->ID_Location->EditAttrs["class"] = "form-control";
			$this->ID_Location->EditCustomAttributes = "";
			$this->ID_Location->EditValue = HtmlEncode($this->ID_Location->CurrentValue);
			$curVal = strval($this->ID_Location->CurrentValue);
			if ($curVal <> "") {
				$this->ID_Location->EditValue = $this->ID_Location->lookupCacheOption($curVal);
				if ($this->ID_Location->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ID_Location`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ID_Location->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ID_Location->EditValue = $this->ID_Location->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ID_Location->EditValue = HtmlEncode($this->ID_Location->CurrentValue);
					}
				}
			} else {
				$this->ID_Location->EditValue = NULL;
			}
			$this->ID_Location->PlaceHolder = RemoveHtml($this->ID_Location->caption());

			// Pcs_RemainPicking
			$this->Pcs_RemainPicking->EditAttrs["class"] = "form-control";
			$this->Pcs_RemainPicking->EditCustomAttributes = "";
			$this->Pcs_RemainPicking->EditValue = HtmlEncode($this->Pcs_RemainPicking->CurrentValue);
			$this->Pcs_RemainPicking->PlaceHolder = RemoveHtml($this->Pcs_RemainPicking->caption());

			// MFG
			$this->MFG->EditAttrs["class"] = "form-control";
			$this->MFG->EditCustomAttributes = "";
			$this->MFG->EditValue = HtmlEncode(FormatDateTime($this->MFG->CurrentValue, 7));
			$this->MFG->PlaceHolder = RemoveHtml($this->MFG->caption());

			// Note_PalletId
			$this->Note_PalletId->EditAttrs["class"] = "form-control";
			$this->Note_PalletId->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Note_PalletId->CurrentValue = HtmlDecode($this->Note_PalletId->CurrentValue);
			$this->Note_PalletId->EditValue = HtmlEncode($this->Note_PalletId->CurrentValue);
			$this->Note_PalletId->PlaceHolder = RemoveHtml($this->Note_PalletId->caption());

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
			// PalletID

			$this->PalletID->LinkCustomAttributes = "";
			$this->PalletID->HrefValue = "";

			// Code
			$this->Code->LinkCustomAttributes = "";
			$this->Code->HrefValue = "";

			// IdType
			$this->IdType->LinkCustomAttributes = "";
			$this->IdType->HrefValue = "";

			// ID_Location
			$this->ID_Location->LinkCustomAttributes = "";
			$this->ID_Location->HrefValue = "";

			// Pcs_RemainPicking
			$this->Pcs_RemainPicking->LinkCustomAttributes = "";
			$this->Pcs_RemainPicking->HrefValue = "";

			// MFG
			$this->MFG->LinkCustomAttributes = "";
			$this->MFG->HrefValue = "";

			// Note_PalletId
			$this->Note_PalletId->LinkCustomAttributes = "";
			$this->Note_PalletId->HrefValue = "";

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
		if ($this->ID_Stock->Required) {
			if (!$this->ID_Stock->IsDetailKey && $this->ID_Stock->FormValue != NULL && $this->ID_Stock->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Stock->caption(), $this->ID_Stock->RequiredErrorMessage));
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
		if ($this->IdType->Required) {
			if (!$this->IdType->IsDetailKey && $this->IdType->FormValue != NULL && $this->IdType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IdType->caption(), $this->IdType->RequiredErrorMessage));
			}
		}
		if ($this->ID_Location->Required) {
			if (!$this->ID_Location->IsDetailKey && $this->ID_Location->FormValue != NULL && $this->ID_Location->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Location->caption(), $this->ID_Location->RequiredErrorMessage));
			}
		}
		if ($this->Pcs_RemainPicking->Required) {
			if (!$this->Pcs_RemainPicking->IsDetailKey && $this->Pcs_RemainPicking->FormValue != NULL && $this->Pcs_RemainPicking->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Pcs_RemainPicking->caption(), $this->Pcs_RemainPicking->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Pcs_RemainPicking->FormValue)) {
			AddMessage($FormError, $this->Pcs_RemainPicking->errorMessage());
		}
		if ($this->PCS->Required) {
			if (!$this->PCS->IsDetailKey && $this->PCS->FormValue != NULL && $this->PCS->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PCS->caption(), $this->PCS->RequiredErrorMessage));
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
		if ($this->DateIn->Required) {
			if (!$this->DateIn->IsDetailKey && $this->DateIn->FormValue != NULL && $this->DateIn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateIn->caption(), $this->DateIn->RequiredErrorMessage));
			}
		}
		if ($this->Imp_id->Required) {
			if (!$this->Imp_id->IsDetailKey && $this->Imp_id->FormValue != NULL && $this->Imp_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Imp_id->caption(), $this->Imp_id->RequiredErrorMessage));
			}
		}
		if ($this->User_ID->Required) {
			if (!$this->User_ID->IsDetailKey && $this->User_ID->FormValue != NULL && $this->User_ID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->User_ID->caption(), $this->User_ID->RequiredErrorMessage));
			}
		}
		if ($this->Note_PalletId->Required) {
			if (!$this->Note_PalletId->IsDetailKey && $this->Note_PalletId->FormValue != NULL && $this->Note_PalletId->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Note_PalletId->caption(), $this->Note_PalletId->RequiredErrorMessage));
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
		if ($this->StatusPicking->Required) {
			if (!$this->StatusPicking->IsDetailKey && $this->StatusPicking->FormValue != NULL && $this->StatusPicking->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->StatusPicking->caption(), $this->StatusPicking->RequiredErrorMessage));
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

		// PalletID
		$this->PalletID->setDbValueDef($rsnew, $this->PalletID->CurrentValue, NULL, FALSE);

		// Code
		$this->Code->setDbValueDef($rsnew, $this->Code->CurrentValue, NULL, FALSE);

		// IdType
		$this->IdType->setDbValueDef($rsnew, $this->IdType->CurrentValue, NULL, FALSE);

		// ID_Location
		$this->ID_Location->setDbValueDef($rsnew, $this->ID_Location->CurrentValue, NULL, FALSE);

		// Pcs_RemainPicking
		$this->Pcs_RemainPicking->setDbValueDef($rsnew, $this->Pcs_RemainPicking->CurrentValue, NULL, FALSE);

		// MFG
		$this->MFG->setDbValueDef($rsnew, UnFormatDateTime($this->MFG->CurrentValue, 7), NULL, FALSE);

		// Note_PalletId
		$this->Note_PalletId->setDbValueDef($rsnew, $this->Note_PalletId->CurrentValue, NULL, FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tbl_stocklist.php"), "", $this->TableVar, TRUE);
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
						case "x_IdType":
							break;
						case "x_ID_Location":
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