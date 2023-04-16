# CoreUI Tabs

### Composer install

`composer install shabuninil/coreui-tabs-php`

### Example usage

```php
    $tabs = new \CoreUI\Tabs('tabs-panel-id');
    $tabs->setTitle('Component Tabs', 'CoreUI Framework');
    
    $tabs->setTabsType($tabs::TABS_TYPE_TABS);
    $tabs->setTabsPosition($tabs::TABS_POS_TOP_LEFT);
    $tabs->setTabsFill($tabs::TABS_FILL_JUSTIFY);
    $panel->setTabsWidth(200);
    
    
    $tabs->addTab('Home',    'tab1', 'data/tab1.json')->active(true);
    $tabs->addTab('Profile', 'tab2', 'data/tab2.json');
    $tabs->addTab('Disabled')->disabled(true);
    
    $tab_dropdown = $tabs->addDropdown('Dropdown');
    $tab_dropdown->addItem('Tab title 3')->disabled(true);
    $tab_dropdown->addItem('Tab title 4', 'tab4', 'data/tab3.json');
    $tab_dropdown->addDivider();
    $tab_dropdown->addItem('Tab title 5', 'tab5', 'data/tab4.json');

    // Переопределение активного таба 
    $tabs->setActiveTab('tab2');
    
    $tabs->setContent('Your content 1');

    echo json_encode($tabs->toArray());
```

Output
```json
{
    "component": "coreui.tabs",
    "id": "tabs-panel-id",
    "title": "Component Tabs",
    "subtitle": "CoreUI Framework",
    "tabsType": "tabs",
    "tabsPosition": "top-left",
    "tabsFill": "justify",
    "tabsWidth": 200,
    "tabs": [
        {"id": "tab1", "title": "Home", "active": false, "url": "data/tab1.json"},
        {"id": "tab2", "title": "Profile", "active": true, "url": "data/tab2.json"},
        {"id": "tab3", "title": "Disabled", "disabled": true},
        {
            "title": "Dropdown",
            "type": "dropdown",
            "items": [
                {"id": "tab4", "title": "Tab title 3", "disabled": true},
                {"id": "tab5", "title": "Tab title 4", "active": false, "url": "data/tab3.json"},
                {"type": "divider"},
                {"id": "tab6","title": "Tab title 5", "active": false, "url": "data/tab4.json"}
            ]
        }
    ],
    "content": "Your content 1"
}
```