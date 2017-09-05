/*
 * Angular 2 decorators and services
 */
import { Component, ViewEncapsulation } from '@angular/core';

import { AppState } from './app.service';
import {LeftNav} from './_layout/left-nav.component';
import {MenuLink} from './_layout/menu-link.component';
import {MenuToggle} from './_layout/menu-toggle.component';


/*
 * App Component
 * Top Level Component
 */
@Component({
  selector: 'app',
  directives: [
    LeftNav,
    MenuLink,
    MenuToggle

  ],
  encapsulation: ViewEncapsulation.None,
  styleUrls: [
    './app.style.scss'
  ],
  templateUrl: 'app.template.html'
})

export class App {
  title = 'Closetbox New Admin';
  url = 'http://www.closetbox.me';
  menuItems = [];
  openedMenu = null;

  constructor(
    public appState: AppState) {

    /**
     * Prepare navbar menu items
     */
    this.menuItems.push({
      title: 'HOME',
      state: 'app.home',
      type: 'link',
      path: 'home'
    });

    this.menuItems.push({
      title: 'FORECAST',
      type: 'toggle',
      pages: [{
        title: 'Calendar',
        type: 'link',
        state: 'app.forecast.calendar',
        icon: 'fa fa-group',
        path: 'calendar'
      }, {
        title: 'Operations',
        state: 'app.forecast.operations',
        type: 'link',
        icon: 'fa fa-map-marker',
        path: 'operations'
      }]
    });

    this.menuItems.push({
      title: 'ORDERS',
      state: 'app.orders',
      type: 'link',
      path: 'orders'
    });

    this.menuItems.push({
      title: 'PROSPECT',
      state: 'app.prospect',
      type: 'link',
      path: 'prospect'
    });

    this.menuItems.push({
      title: 'REPORTING',
      state: 'app.reporting',
      type: 'link',
      path: 'reporting'
    });

    this.menuItems.push({
      title: 'ADMIN',
      type: 'toggle',
      pages: [{
        title: 'Agents',
        type: 'link',
        state: 'app.admin.agents',
        icon: 'fa fa-group',
        path: 'agents'
      }, {
        title: 'Containers',
        state: 'app.admin.containers',
        type: 'link',
        icon: 'fa fa-map-marker',
        path: 'containers'
      }, {
        title: 'Discounts',
        state: 'app.admin.discounts',
        type: 'link',
        icon: 'fa fa-map-marker',
        path: 'discounts'
      }, {
        title: 'Markets',
        state: 'app.admin.markets',
        type: 'link',
        icon: 'fa fa-map-marker',
        path: 'markets'
      }, {
        title: 'Parameters',
        state: 'app.admin.parameters',
        type: 'link',
        icon: 'fa fa-map-marker',
        path: 'parameters'
      }, {
        title: 'Warehouses',
        state: 'app.admin.warehouses',
        type: 'link',
        icon: 'fa fa-map-marker',
        path: 'warehouses'
      }]
    });

    this.menuItems.push({
      title: 'SYSTEM',
      type: 'toggle',
      pages: [{
        title: 'Access',
        type: 'link',
        state: 'app.system.access',
        icon: 'fa fa-group',
        path: 'access'
      }, {
        title: 'Logging',
        state: 'app.system.logging',
        type: 'link',
        icon: 'fa fa-map-marker',
        path: 'logging'
      }, {
        title: 'Configuration',
        state: 'app.system.configuration',
        type: 'link',
        icon: 'fa fa-map-marker',
        path: 'configuration'
      }]
    });


  }

  ngOnInit() {
    console.log('Initial App State', this.appState.state);
  }

  isMenuSelected(menu) {
    return this.openedMenu === menu;
  }

  toggleSelectSection(menu) {
    this.openedMenu = (this.openedMenu === menu ? null : menu);
  }

  // selectPage(menu, page) {
  //   page && page.url && $location.path(page.url);
  //   self.currentSection = section;
  //   self.currentPage = page;
  // }

}
