/*
 * Left Nav Bar Directive
 */
import { Component} from '@angular/core';


/*
 * App Component
 * Top Level Component
 */
@Component({
  selector: 'left-nav',
  templateUrl: './left-nav.template.html'
})
export class LeftNav {
  name = 'Simple Component';
  url = 'http://www.closetbox.me';

  constructor() {

  }

  ngOnInit() {
    console.log('Left Nav Bar');
  }

}

