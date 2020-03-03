

              <div class="page-body vertical-menu-mt">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                  <h3>Form Builder 2</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Form Builder</li>
                    <li class="breadcrumb-item active">Form Builder 2</li>
                  </ol>
                </div>
                <div class="col-lg-6">
                  <!-- Bookmark Start-->
                  <div class="bookmark pull-right">
                    <ul>
                      <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Tables"><i data-feather="inbox"></i></a></li>
                      <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>
                      <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Icons"><i data-feather="command"></i></a></li>
                      <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>
                      <li><a href="#"><i class="bookmark-search" data-feather="star"></i></a>
                        <form class="form-inline search-form">
                          <div class="form-group form-control-search">
                            <input type="text" placeholder="Search..">
                          </div>
                        </form>
                      </li>
                    </ul>
                  </div>
                  <!-- Bookmark Ends-->
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="form-builder">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-12">
                  <div class="card">
                    <div class="card-header">
                      <h5>Form Builder</h5>
                    </div>
                    <div class="card-body form-builder">
                      <div class="form-builder-column">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-builder-2-header">
                              <div>
                                <ul class="nav nav-primary" id="pills-tab" role="tablist">
                                  <li class="nav-item"><a class="nav-link active" id="pills-input-tab" data-toggle="pill" href="#pills-input" role="tab" aria-controls="pills-input" aria-selected="true">Input</a></li>
                                  <li class="nav-item"><a class="nav-link" id="pills-radcheck-tab" data-toggle="pill" href="#pills-radcheck" role="tab" aria-controls="pills-radcheck" aria-selected="false">Radio/Checkbox</a></li>
                                  <li class="nav-item"><a class="nav-link" id="pills-select-tab" data-toggle="pill" href="#pills-select" role="tab" aria-controls="pills-select" aria-selected="false">Select</a></li>
                                  <li class="nav-item"><a class="nav-link" id="pills-button-tab" data-toggle="pill" href="#pills-button" role="tab" aria-controls="pills-button" aria-selected="false">Buttons</a></li>
                                </ul>
                              </div>
                              <div>
                                <nav class="navbar navbar-expand-md p-0">
                                  <form class="form-inline">
                                    <div class="form-group">
                                      <select class="btn form-control b-light digits" id="n-columns">
                                        <option value="1">1 Column</option>
                                        <option value="2">2 Columns</option>
                                      </select>
                                    </div>
                                    <button class="btn btn-primary copy-btn" id="copy-to-clipboard" type="submit" data-clipboard-text="testing">Copy HTML</button>
                                  </form>
                                </nav>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-xl-6">
                            <div class="tab-content" id="pills-tabContent">
                              <div class="tab-pane fade show active" id="pills-input" role="tabpanel" aria-labelledby="pills-input-tab">
                                <form class="theme-form">
                                  <div class="form-group draggable">
                                    <label for="input-text-1">Text Input</label>
                                    <input class="form-control btn-square" id="input-text-1" type="email" placeholder="Enter email">
                                    <p class="help-block">Example block-level help text here.</p>
                                  </div>
                                  <hr>
                                  <div class="form-group draggable">
                                    <label for="input-password-1">Password</label>
                                    <input class="form-control btn-square" id="input-password-1" type="password" placeholder="Password">
                                    <p class="help-block">Example block-level help text here.</p>
                                  </div>
                                  <hr>
                                  <div class="form-group draggable">
                                    <label for="select-1">Select</label>
                                    <select class="form-control btn-square" id="select-1">
                                      <option value="Option 1">Option 1</option>
                                      <option value="Option 2">Option 2</option>
                                      <option value="Option 3">Option 3</option>
                                    </select>
                                    <p class="help-block">Example block-level help text here.</p>
                                  </div>
                                  <hr>
                                  <div class="form-group draggable">
                                    <label for="input-file-1">File input</label>
                                    <input id="input-file-1" type="file">
                                    <p class="help-block">Example block-level help text here.</p>
                                  </div>
                                  <hr>
                                  <div class="form-group draggable">
                                    <label for="prependedcheckbox">Appended Checkbox</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend"><span class="input-group-text">
                                          <input type="checkbox"></span></div>
                                      <input class="form-control btn-square" id="prependedcheckbox" name="prependedcheckbox" type="text" placeholder="Placeholder">
                                    </div>
                                    <p class="help-block">Example block-level help text here.</p>
                                  </div>
                                  <hr>
                                  <div class="form-group draggable">
                                    <label for="prependedcheckbox">Button DropDown</label>
                                    <div class="input-group">
                                      <input class="form-control btn-square" id="buttondropdown" name="buttondropdown" placeholder="Placeholder" type="text">
                                      <div class="input-group-btn btn btn-square p-0">
                                        <button class="btn btn-primary dropdown-toggle btn-square" type="button" data-toggle="dropdown">Action<span class="caret"></span></button>
                                        <ul class="dropdown-menu pull-right">
                                          <li><a class="dropdown-item" href="#">Option one</a></li>
                                          <li><a class="dropdown-item" href="#">Option two</a></li>
                                          <li><a class="dropdown-item" href="#">Option three</a></li>
                                        </ul>
                                      </div>
                                    </div>
                                    <p class="help-block">Example block-level help text here.</p>
                                  </div>
                                </form>
                              </div>
                              <div class="tab-pane fade" id="pills-radcheck" role="tabpanel" aria-labelledby="pills-radcheck-tab">
                                <form class="theme-form">
                                  <div class="form-group draggable">
                                    <label>Inline checkbox</label>
                                    <div class="col">
                                      <div class="m-checkbox-inline">
                                        <div class="checkbox">
                                          <input id="checkbox1" type="checkbox">
                                          <label for="checkbox1">Default 1</label>
                                        </div>
                                        <div class="checkbox">
                                          <input id="checkbox2" type="checkbox">
                                          <label for="checkbox2">Default 2</label>
                                        </div>
                                        <div class="checkbox">
                                          <input id="checkbox3" type="checkbox">
                                          <label for="checkbox3">Default 3</label>
                                        </div>
                                      </div>
                                    </div>
                                    <p class="help-block m-t-help-block">Example block-level help text here.</p>
                                  </div>
                                  <hr>
                                  <div class="form-group draggable">
                                    <label>Inline Radiobox</label>
                                    <div class="col">
                                      <div class="m-checkbox-inline">
                                        <div class="radio radio-theme">
                                          <input id="radioinline1" type="radio" name="radio1" value="option1">
                                          <label for="radioinline1">Option 1</label>
                                        </div>
                                        <div class="radio radio-theme">
                                          <input id="radioinline2" type="radio" name="radio1" value="option2">
                                          <label for="radioinline2">Option 2</label>
                                        </div>
                                        <div class="radio radio-theme">
                                          <input id="radioinline3" type="radio" name="radio1" value="option3">
                                          <label for="radioinline3">Option 3</label>
                                        </div>
                                      </div>
                                    </div>
                                    <p class="help-block m-t-help-block">Example block-level help text here.</p>
                                  </div>
                                  <hr>
                                  <div class="form-group draggable">
                                    <label>Custom checkbox</label>
                                    <div class="col">
                                      <div class="form-group">
                                        <div class="checkbox">
                                          <input id="checkbox-def" type="checkbox">
                                          <label for="checkbox-def">Default</label>
                                        </div>
                                        <div class="checkbox">
                                          <input id="checkbox-dis" type="checkbox" disabled="">
                                          <label for="checkbox-dis">Disabled</label>
                                        </div>
                                        <div class="checkbox">
                                          <input id="checkbox-chk" type="checkbox" checked="">
                                          <label for="checkbox-chk">Checked</label>
                                        </div>
                                      </div>
                                    </div>
                                    <p class="help-block">Example block-level help text here.</p>
                                  </div>
                                </form>
                              </div>
                              <div class="tab-pane fade" id="pills-select" role="tabpanel" aria-labelledby="pills-select-tab">
                                <form class="theme-form">
                                  <div class="form-group draggable">
                                    <label for="formcontrol-select1">Example select</label>
                                    <select class="form-control btn-square" id="formcontrol-select1">
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                    </select>
                                    <p class="help-block">Example block-level help text here.</p>
                                  </div>
                                  <hr>
                                  <div class="form-group draggable">
                                    <label for="formcontrol-select2">Example multiple select</label>
                                    <select class="form-control btn-square" id="formcontrol-select2" multiple="">
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                    </select>
                                    <p class="help-block">Example block-level help text here.</p>
                                  </div>
                                </form>
                              </div>
                              <div class="tab-pane fade" id="pills-button" role="tabpanel" aria-labelledby="pills-button-tab">
                                <form class="theme-form">
                                  <div class="form-group draggable">
                                    <label class="m-r-10">Single Button</label><br>
                                    <button class="btn btn-primary active" type="button" data-original-title="btn btn-dark active" title="">Button</button>
                                    <p class="help-block">Example block-level help text here.</p>
                                  </div>
                                  <hr>
                                  <div class="form-group draggable">
                                    <label class="m-r-10">Double Button</label><br>
                                    <button class="btn btn-primary" type="button" data-original-title="btn btn-primary-gradien" title="">Primary</button>
                                    <button class="btn btn-secondary" type="button" data-original-title="btn btn-primary-gradien" title="">Secondary</button>
                                    <p class="help-block">Example block-level help text here.</p>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-xl-6 lg-mt">
                            <!-- Form builder column wise start-->
                            <div class="drag-bx card-body">
                              <div class="text-muted empty-form text-center">
                                <h6>Drag & Drop elements to build form.</h6>
                              </div>
                              <div class="form-body row form-builder-2">
                                <div class="col-md-12 droppable sortable"></div>
                                <div class="col-md-6 droppable sortable" style="display: none;"></div>
                                <div class="col-md-6 droppable sortable" style="display: none;"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Form builder column wise ends-->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>

