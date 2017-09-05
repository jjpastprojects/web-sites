# Any business logic errors from the service classes should be wrapped 
# in this error so it's to consume this from the controllers.
class ServiceError < StandardError
end
