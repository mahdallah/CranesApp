using System;
using System.Linq;
using HijazCranes.Models;
using HijazCranes.ViewModels;
using System.Collections.Generic;
using System.Web;
using System.Web.Mvc;
using System.Data.Entity;
using System.Data;

namespace HijazCranes.Controllers
{
    public class CustomersController : Controller
    {
        // GET: Customers
        private readonly ApplicationDbContext _context;
        public CustomersController()
        {
            _context = new ApplicationDbContext();
        }
        protected override void Dispose(bool disposing)
        {
            _context.Dispose();
        }
        // GET: Customers
        public ActionResult Index()
        {
            var customers = _context.Customers;
            return View(customers.ToList());
        }

        // GET: Customers/Create
        public ActionResult Create()
        {
            var viewModel = new CustomerFormViewModel();
            return View("CustomerForm", viewModel);
        }

        // GET: Customers/Details/5
        public ActionResult Details(int id)
        {
            var customerObj = _context.Customers.Include(c => c.CustomerContacts).SingleOrDefault(c => c.Id == id);

            if (customerObj == null)
                return HttpNotFound();

            return View(customerObj);
        }

        // GET: Customers/Edit/5
        public ActionResult Edit(int id)
        {
            var customerObj = _context.Customers.SingleOrDefault(c => c.Id == id);
            if (customerObj == null)
                return HttpNotFound();
            var viewModel = new CustomerFormViewModel
            {
                Customer = customerObj
            };
            return View("CustomerForm", viewModel);
        }

        // GET: Customers/Delete/5
        public ActionResult Delete(int id)
        {
            Customer customerToBeDeleted = _context.Customers.SingleOrDefault(c => c.Id == id);
            if (customerToBeDeleted == null)
            {
                return HttpNotFound();
            }
            _context.Customers.Remove(customerToBeDeleted);
            _context.SaveChanges();
            return RedirectToAction("Index", "Customers");
        }

        // GET: Customers/GetCustomerContact/5
        public JsonResult GetCustomerContact(int id)
        {
            if (id != 0)
            {
                var listContacts = _context.CustomerContacts.Where(c => c.Customer_Id == id);
                var contacts = new List<object>();
                foreach (var contact in listContacts)
                {
                    var customerContacts = new CustomerContact
                    {
                        Contact = contact.Contact,
                        Id = contact.Id,
                        ContactType = contact.ContactType,
                        Default = contact.Default
                    };
                    contacts.Add(customerContacts);
                }
                return Json(contacts, JsonRequestBehavior.AllowGet);
            }
            else
            {
                return Json(new { message = "New Customer" }, JsonRequestBehavior.AllowGet);
            }
        }

        // POST: Customers/Create
        [HttpPost]
        public JsonResult Create(SaveCustomerViewModel viewModel)
        {
            if (ModelState.IsValid)
            {
                var Id = viewModel.Customer.Id;
                var FirstName = viewModel.Customer.FirstName;
                var LastName = viewModel.Customer.LastName;
                var Contacts = viewModel.Contacts;
                // Create Customer
                var customer = new Customer
                {
                    FirstName = FirstName,
                    LastName = LastName
                };
                _context.Customers.Add(customer);
                _context.SaveChanges();
                // Add Customer Contacts
                var CustomerId = _context.Customers.Max(c => c.Id);
                foreach (var contact in Contacts)
                {
                    var customerContact = new CustomerContact
                    {
                        Contact = contact.Contact,
                        Customer_Id = CustomerId,
                        Default = contact.Default,
                        ContactType = contact.ContactType
                    };
                    _context.CustomerContacts.Add(customerContact);
                }
                _context.SaveChanges();
                return Json(data: new { messsage = "Saved Successfully", success = "true" });
            }
            else
            {
                return Json(data: new { messsage = "Something went wrong", success = "false" });
            }
            
        }

        // POST: Customers/Edit/5
        [HttpPost]
        public ActionResult Edit(SaveCustomerViewModel viewModel)
        {
            var isValid = TryUpdateModel(viewModel);
            if (ModelState.IsValid)
            {
                var Id = viewModel.Customer.Id;
                var FirstName = viewModel.Customer.FirstName;
                var LastName = viewModel.Customer.LastName;
                var Contacts = viewModel.Contacts;
                // Edit Customer
                var customerInDb = _context.Customers.Single(c => c.Id == Id);
                customerInDb.FirstName = FirstName;
                customerInDb.LastName = LastName;

                // Delete
                var contactsInDB = _context.CustomerContacts.Where(c => c.Customer_Id == Id);
                var myIds = Contacts.Select(x => x.Id).Distinct().ToList();
                var toBeDeleted = contactsInDB.Where(x => !myIds.Contains(x.Id));
                if (toBeDeleted != null)
                {
                    _context.CustomerContacts.RemoveRange(toBeDeleted);
                }
                foreach (var contact in Contacts)
                {
                    // New
                    if (contact.Id == 0)
                    {
                        var customerContact = new CustomerContact
                        {
                            Contact = contact.Contact,
                            Customer_Id = Id,
                            Default = contact.Default,
                            ContactType = contact.ContactType
                        };
                        _context.CustomerContacts.Add(customerContact);
                    }
                    // Update && Not Updated
                    else
                    {
                        var customerContactToBeUpdated = contactsInDB.Where(c => c.Id == contact.Id);
                        if (customerContactToBeUpdated != null)
                        {
                            foreach (var contactTobeUpdated in customerContactToBeUpdated)
                            {
                                contactTobeUpdated.Contact = contact.Contact;
                                contactTobeUpdated.Default = contact.Default;
                                contactTobeUpdated.ContactType = contact.ContactType;
                            }
                        }
                    }
                }
                _context.SaveChanges();
                return Json(data: new { messsage = "Edited Succesfully", success = "ture" });
            }
            else
            {
                return Json(data: new { messsage = "Something went wrong", success= "false" });
            }
        }
    }
}