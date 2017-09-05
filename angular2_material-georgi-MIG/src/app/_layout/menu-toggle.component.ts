/*
 * Menu Link Directive
 */
import { Component} from '@angular/core';

import {MenuLink} from './menu-link.component';
import { ROUTER_DIRECTIVES } from '@angular/router';
/*
 * Menu Toggle Component
 */
@Component({
  selector: 'menu-toggle',
  templateUrl: './menu-toggle.template.html',
  directives: [
    MenuLink,
    ROUTER_DIRECTIVES
  ],
  inputs: ['menu:menu']
})
export class MenuToggle {

  menu = null;
  opened = false;

  constructor() {

  }

  ngOnInit() {
    
  }

  isOpen() {
    return true;
  }

  // toggle the opened variable
  toggle() {
    this.opened = !this.opened;
  }


}

