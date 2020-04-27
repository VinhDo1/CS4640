import { Component } from '@angular/core';
import { Register } from './register';
import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'Register';

  constructor(private http: HttpClient) {   }

  // Let's create a property to store a response from the back end
  // and try binding it back to the view
  responsedata = new Register('', '', '', '', false);

  questions = ['What is your favorite color?', 'What was the name of your elementary school?', 'What was your first pet\'s name?'];
  registerModel = new Register('', '', '', '', false);


  confirm_msg = '';
  data_submitted = '';

  confirmRegister(data) {
     console.log(data);
     this.confirm_msg = 'Successfully registered, ' + data.username + '!';
  }


  // Assume we want to send a request to the backend when the form is submitted
  // so we add code to send a request in this function

  onSubmit(form: any): void {
     console.log('You submitted value: ', form);
     this.data_submitted = form;

    //  console.log(form['username']);
          
     // Convert the form data to json format
     let params = JSON.stringify(form);

     // To send a GET request, use the concept of URL rewriting to pass data to the backend
    //  this.http.get<Register>('http://localhost:81/cs4640/ng.php?str='+params)
     // To send a POST request, pass data as an object
     console.log(params);
     this.http.post<Register>('http://localhost:81/cs4640/ng.php', params)
     .subscribe((data) => {
          // Receive a response successfully, do something here
          console.log('Response from backend ', data);
          this.responsedata = data;     // assign response to responsedata property to bind to screen later
     }, (error) => {
          // An error occurs, handle an error in some way
          console.log('Error ', error);
     })
  }
}
