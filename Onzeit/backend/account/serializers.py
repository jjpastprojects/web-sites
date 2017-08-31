from rest_framework import serializers
from account.models import Employee, Employer
###############################################################################
### Crypt, decrypt func
###############################################################################
from Crypto.Cipher import AES
import base64

MASTER_KEY="Some-long-base-key-to-use-as-encyrption-key"

def encrypt_val(clear_text):
    enc_secret = AES.new(MASTER_KEY[:32])
    tag_string = (str(clear_text) +
                  (AES.block_size -
                   len(str(clear_text)) % AES.block_size) * "\0")
    cipher_text = base64.b64encode(enc_secret.encrypt(tag_string))

    return cipher_text

def decrypt_val(cipher_text):
    dec_secret = AES.new(MASTER_KEY[:32])
    raw_decrypted = dec_secret.decrypt(base64.b64decode(cipher_text))
    clear_val = raw_decrypted.rstrip("\0")
    return clear_val

###############################################################################
### Phone verify
###############################################################################
class PhoneVerifySerializer(serializers.Serializer):
    username = serializers.CharField(required=True, allow_blank=False, max_length=30)
    password = serializers.CharField(required=True, allow_blank=True, max_length=64)
    phone = serializers.CharField(required=True, allow_blank=False, max_length=30)

    def create(self, validated_data):
        """
        Create and return a new `Employee` instance, given the validated data.
        """
        # return Snippet.objects.create(**validated_data)
        return Employee.objects.get(username=username)


    def update(self, instance, validated_data):
        """
        Update and return an existing `Employee` instance, given the validated data.
        """
        instance.verify_phone = validated_data.get('phone', instance.verify_phone)
        instance.save()
        return instance

###############################################################################
### Employee
###############################################################################

class EmployeeSerializer(serializers.ModelSerializer):
    class Meta:
        model = Employee
        fields = ('id', 'username', 'email', 'password', 'city', 'phone', 'zipcode', 'distance', 'ssn', 'is_verified', 'verify_phone', 'last_verified', 'passcode')

    def create(self, validated_data):
        password = validated_data.pop('password', None)
        instance = self.Meta.model(**validated_data)
        setattr(instance, 'password', encrypt_val(password))
        instance.save()
        return instance

    def update(self, instance, validated_data):
        for attr, value in validated_data.items():
            if attr == 'password':
                setattr(instance, attr, encrypt_val(value))
            else:
                setattr(instance, attr, value)
        instance.save()
        return instance

###############################################################################
### Employer
###############################################################################

class EmployerSerializer(serializers.ModelSerializer):
    class Meta:
        model = Employer
        fields = ('id', 'username', 'email', 'password', 'is_verified', 'fb_name', 'ac_name', 'ss_no', 'bm_addr', 'city', 'state', 'zipcode', 'distance', 'o_phone', 'c_phone', 'w_phone', 'b_fax', 'verify_phone', 'last_verified', 'passcode')

    def create(self, validated_data):
        password = validated_data.pop('password', "")
        instance = self.Meta.model(**validated_data)
        setattr(instance, 'password', encrypt_val(password))
        instance.save()
        return instance

    def update(self, instance, validated_data):
        for attr, value in validated_data.items():
            if attr == 'password':
                setattr(instance, attr, encrypt_val(value))
            else:
                setattr(instance, attr, decrypt_val(value))
        instance.save()
        return instance

