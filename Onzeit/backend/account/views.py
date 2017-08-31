"""
made by lucas
"""

from django.http import HttpResponse
from django.views.decorators.csrf import csrf_exempt
from rest_framework.renderers import JSONRenderer
from rest_framework.parsers import JSONParser
from account.models import BaseUser, Employee, Employer
from account.serializers import EmployeeSerializer, EmployerSerializer, encrypt_val, decrypt_val

from random import randint
from django.core.exceptions import ObjectDoesNotExist

from twilio.rest import TwilioRestClient

def send_twilio_message(phone, code):
    account_sid ="sid key"
    auth_token = "token key"
    client = TwilioRestClient(account_sid, auth_token)

    msg = 'Your code is %s' % (code)
    print msg
    message = client.messages.create(
        to = phone,
        from_ = '+17863453851',
        body = msg,
    )
    
    print message.sid
    return message.sid

def random_with_N_digits(n):
    range_start = 10 ** (n-1)
    range_end = (10**n)-1
    return randint(range_start, range_end)

class JSONResponse(HttpResponse):
    """
    An HttpResponse that renders its content into JSON.
    """
    def __init__(self, data, **kwargs):
        content = JSONRenderer().render(data)
        kwargs['content_type'] = 'application/json'
        super(JSONResponse, self).__init__(content, **kwargs)


##################################################################################################
#### new hire intake
##################################################################################################
@csrf_exempt
def newhireintake(request):
    """
    name: type = employee : employer
    """

    if request.method == 'POST':
        data = JSONParser().parse(request)
        username = data.get('username', '')
        password = data.get('password', '')
        ssn = data.get('ssn', '')

        # print ssn
        # print data

        employee = Employee.objects.get(username=username)
        print employee
        if employee.password != password:
            return JSONResponse(res="wrong password", status=400)

        if employee.is_verified != True:
            return JSONResponse(res="inactive user", status=400)
        
        employee.ssn = ssn
        employee.save()
        
        return JSONResponse("ok", status=201)
    
##################################################################################################
#### generate_passcode
##################################################################################################
@csrf_exempt
def login(request, type='employee'):
    """
    name: type = employee : employer
    """

    if request.method == 'POST':
        data = JSONParser().parse(request)
        username = data.get('username', '')
        password = data.get('password', '')

        print username
        print password
        
        if type == 'employee':
            try:
                employee = Employee.objects.get(username=username)
            except ObjectDoesNotExist:
                try:
                    employee = Employee.objects.get(email=username)
                except ObjectDoesNotExist:
                    return JSONResponse({'res':'Invalid User!'}, status=301)

            if decrypt_val(employee.password) != password:
                return JSONResponse({'res':'Invalid password!'}, status=302)

            if employee.is_verified != True:
                return JSONResponse({'res':'Not verified!'}, status=303)

            serializer = EmployeeSerializer(employee)
            return JSONResponse(serializer.data, status=201)
            

        elif type == 'employer':
            try:
                employer = Employer.objects.get(username=username)
            except ObjectDoesNotExist:
                try:
                    employer = Employer.objects.get(email=username)
                except ObjectDoesNotExist:
                    return JSONResponse({'res':'Invalid User!'}, status=301)

            if decrypt_val(employer.password) != password:
                return JSONResponse({'res':'Invalid password!'}, status=302)

            if employer.is_verified != True:
                return JSONResponse({'res':'Not verified!'}, status=303)

            serializer = EmployerSerializer(employee)
            return JSONResponse(serializer.data, status=201)
            

        return JSONResponse({'res':'Invalid type!'}, status=400)
##################################################################################################
#### generate_passcode
##################################################################################################
@csrf_exempt
def generate_passcode(request, type='employee'):
    """
    name: type = employee : employer
    """

    if request.method == 'POST':
        data = JSONParser().parse(request)
        username = data.get('username', '')
        password = data.get('password', '')
        phone = data.get('phone', '')

        if type == 'employee':
            employee = Employee.objects.get(username=username)
            if employee.password != password:
                return JSONResponse(res="wrong password", status=400)

            employee.verify_phone = phone
            employee.passcode = random_with_N_digits(5)
            employee.save()
            print employee.passcode

            send_twilio_message(phone, employee.passcode)

            return JSONResponse("ok", status=201)

        elif type == 'employer':
            print 'employer'
            employer = Employer.objects.get(username=username)
            print employer.username
            if employer.password != password:
                return JSONResponse(res="wrong password", status=400)

            employer.verify_phone = phone
            employer.passcode = random_with_N_digits(5)
            employer.save()
            print employer.passcode
            send_twilio_message(phone, employer.passcode)
            return JSONResponse("ok", status=201)

        
        return JSONResponse(res="wrong password", status=400)
##################################################################################################
#### verify_passcode
##################################################################################################
@csrf_exempt
def verify_passcode(request, type='employee'):
    """
    name: type = employee : employer
    """

    if request.method == 'POST':
        data = JSONParser().parse(request)
        username = data.get('username', '')
        password = data.get('password', '')
        code = data.get('code', '')
        code = ''.join(code.split()) #remove space in string

        if type == 'employee':
            employee = Employee.objects.get(username=username)
            if employee.password != password:
                return JSONResponse({'res':'Invalid password!'}, status=302)

            if employee.passcode != code:
                return JSONResponse({'res':'Invalid passcode!'}, status=303)

            employee.is_verified = True
            employee.save()
            print employee
            return JSONResponse("ok", status=201)

        elif type == 'employer':
            employer = Employer.objects.get(username=username)
            if employer.password != password:
                return JSONResponse({'res':'Invalid password!'}, status=302)

            if employer.passcode != code:
                return JSONResponse({'res':'Invalid passcode!'}, status=304)

            employer.is_verified = True
            employer.save()
            print employer
            return JSONResponse("ok", status=201)
        
        return JSONResponse({'res':'Invalid type'}, status=400)

##################################################################################################
#### Employee
##################################################################################################
@csrf_exempt
def employee_list(request):
    """
    List all code employees, or create a new employee.
    """
    if request.method == 'GET':
        employees = Employee.objects.all()
        serializer = EmployeeSerializer(employees, many=True)
        return JSONResponse(serializer.data)

    elif request.method == 'POST':
        data = JSONParser().parse(request)
        serializer = EmployeeSerializer(data=data)
        if serializer.is_valid():
            serializer.save()
            return JSONResponse(serializer.data, status=201)
        return JSONResponse(serializer.errors, status=400)


@csrf_exempt
def employee_detail(request, pk):
    """
    Retrieve, update or delete a code snippet.
    """
    try:
        employee = Employee.objects.get(pk=pk)
    except Employee.DoesNotExist:
        return HttpResponse(status=404)

    if request.method == 'GET':
        serializer = EmployeeSerializer(employee)
        return JSONResponse(serializer.data)

    elif request.method == 'PUT':
        data = JSONParser().parse(request)
        serializer = EmployeeSerializer(employee, data=data)
        if serializer.is_valid():
            serializer.save()
            return JSONResponse(serializer.data)
        return JSONResponse(serializer.errors, status=400)

    elif request.method == 'DELETE':
        employee.delete()
        return HttpResponse(status=204)

##################################################################################################
#### Employee
##################################################################################################

@csrf_exempt
def employer_list(request):
    """
    List all code employers, or create a new employer.
    """
    if request.method == 'GET':
        employers = Employer.objects.all()
        serializer = EmployerSerializer(employers, many=True)
        return JSONResponse(serializer.data)

    elif request.method == 'POST':
        data = JSONParser().parse(request)
        print data
        serializer = EmployerSerializer(data=data)
        if serializer.is_valid():
            serializer.save()
            return JSONResponse(serializer.data, status=201)
        return JSONResponse(serializer.errors, status=400)


@csrf_exempt
def employer_detail(request, pk):
    """
    Retrieve, update or delete a code snippet.
    """
    try:
        employer = Employer.objects.get(pk=pk)
    except Employer.DoesNotExist:
        return HttpResponse(status=404)

    if request.method == 'GET':
        serializer = EmployerSerializer(employer)
        return JSONResponse(serializer.data)

    elif request.method == 'PUT':
        data = JSONParser().parse(request)
        serializer = EmployerSerializer(employer, data=data)
        if serializer.is_valid():
            serializer.save()
            return JSONResponse(serializer.data)
        return JSONResponse(serializer.errors, status=400)

    elif request.method == 'DELETE':
        employer.delete()
        return HttpResponse(status=204)
