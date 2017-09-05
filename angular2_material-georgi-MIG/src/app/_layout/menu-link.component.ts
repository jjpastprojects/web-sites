/*
 * Menu Link Directive
 */
import { Component} from '@angular/core';


/*
 * Menu Link Component 
 */
@Component({
  selector: 'menu-link',
  templateUrl: './menu-link.template.html',
  inputs: ['menu:menu']
})
export class MenuLink {
  
  menu = null;

  constructor() {

  }

  ngOnInit() {
    console.log('Menu Link');
  }

}

