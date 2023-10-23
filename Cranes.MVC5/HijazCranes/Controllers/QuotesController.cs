using HijazCranes.Models;
using HijazCranes.ViewModels;
using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;

namespace HijazCranes.Controllers
{
    public class QuotesController : Controller
    {
        ApplicationDbContext _context;
        public QuotesController()
        {
            _context = new ApplicationDbContext();
        }
        // Quotes
        protected override void Dispose(bool disposing)
        {
            _context.Dispose();
        }
        // GET: Quotes
        public ActionResult Index()
        {
            return View(_context.Quotes.Include(c => c.Customer).ToList());
        }
        // GET: Quotes/Details/5
        public ActionResult Details(int id)
        {
            var quote = _context.Quotes.Include(c => c.Customer).Include(e => e.Employee).SingleOrDefault(q => q.Id == id);
            var quoteCranes = _context.QuoteCranes.Include(c => c.Crane).Where(qc => qc.Quote_Id == quote.Id).ToList();
            var ids = new List<int>();
            foreach (var item in quoteCranes)
            {
                ids.Add(item.Crane_Id);
            }
            var cranes = _context.Cranes.Where(c => ids.Contains(c.Id)).ToList();
            var viewModel = new QuoteViewModel
            {
                Quote = quote,
                QuoteCranes = quoteCranes,
                Cranes = cranes
            };
            if (viewModel == null)
            {
                return HttpNotFound();
            }
            return View(viewModel);
        }
        // GET: Quotes/Create
        public ActionResult Create()
        {
            var viewModel = new QuoteViewModel
            {
                Cranes = _context.Cranes.ToList(),
                Customers = _context.Customers.ToList(),
                Employee = _context.Employees.SingleOrDefault(e => e.Id == 1)
            };
            return View("QuoteForm", viewModel);
        }
        // GET: Quotes/Edit/5
        public ActionResult Edit(int id)
        {
            var quote = _context.Quotes.SingleOrDefault(q => q.Id == id);
            if (quote == null)
                return HttpNotFound();
            var viewModel = new QuoteViewModel
            {
                Quote = quote,
                Cranes = _context.Cranes.ToList(),
                QuoteCranes = quote.QuoteCranes,
                Customers = _context.Customers.ToList(),
                Employee = _context.Employees.SingleOrDefault(e => e.Id == 1)
            };
            return View("QuoteForm", viewModel);
        }
        // GET: Quotes/Delete/5
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Quote quote = _context.Quotes.Include(e => e.Employee).Include(c => c.Customer).SingleOrDefault(q => q.Id == id);
            if (quote == null)
            {
                return HttpNotFound();
            }
            var quoteCranes = _context.QuoteCranes.Include(c => c.Crane).Where(qc => qc.Quote_Id == quote.Id).ToList();
            var viewModel = new QuoteViewModel
            {
                Quote = quote,
                QuoteCranes = quoteCranes,
            };
            return View(viewModel);
        }
        // POST: Quotes/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult Delete(int id)
        {
            var toBeDeleted = _context.Quotes.SingleOrDefault(c => c.Id == id);
            _context.Quotes.Remove(toBeDeleted);
            _context.SaveChanges();
            return RedirectToAction("Index");
        }

        //GET: Quotes/GetPrice?id=5&priceType=Hours
        public JsonResult GetPrice(int id, string priceType)
        {
            var inDb = _context.Cranes.SingleOrDefault(c => c.Id == id);
            if (inDb != null)
            {
                if (priceType == "hours")
                {
                    var perHour = inDb.PricePerHour;
                    return Json(new { price = perHour }, JsonRequestBehavior.AllowGet);
                }
                if (priceType == "items")
                {
                    var perItem = inDb.PricePerItem;
                    return Json(new { price = perItem }, JsonRequestBehavior.AllowGet);
                }
                else
                {
                    return Json(new { message = "price type not valid" }, JsonRequestBehavior.AllowGet);
                }

            }
            return Json(new { message = "Not Found" }, JsonRequestBehavior.AllowGet);
        }

        //GET: Quotes/GetQuoteCranes/5
        public JsonResult GetQuoteCranes(int id)
        {
            var quote = _context.Quotes.SingleOrDefault(q => q.Id == id);
            if (quote == null)
            {
                return Json(new { success = "false", message = "No such quote in Database" }, JsonRequestBehavior.AllowGet);
            }
            var quoteCranesInDb = _context.QuoteCranes.Include(c => c.Crane).Where(q => q.Quote_Id == id);
            var quoteCranes = new List<QuoteCranes>();
            foreach (var quoteCrane in quoteCranesInDb)
            {
                var quoteCraneObj = new QuoteCranes()
                {
                    Id = quoteCrane.Id,
                    //Quote = quoteCrane.Quote,
                    Crane = quoteCrane.Crane,
                    HiredHours = quoteCrane.HiredHours,
                    HiredItems = quoteCrane.HiredItems,
                    Price = quoteCrane.Price
                };
                quoteCranes.Add(quoteCraneObj);
            }
            return Json(new { success = "true", message = "I got you homi", quoteCranes = quoteCranes }, JsonRequestBehavior.AllowGet);
        }

        //POST: Quotes/Create
        [HttpPost]
        public JsonResult Create(SaveQuoteViewModel viewModel)
        {
            if (!ModelState.IsValid)
            {
                return Json(new { success = false, message = "Model is Not valid " }, JsonRequestBehavior.DenyGet);
            }
            var total = 0;
            var quote = viewModel.Quote;
            foreach (var quoteCrane in viewModel.QuoteCranes)
            {
                var hours = quoteCrane.HiredHours == null ? 0 : quoteCrane.HiredHours;
                var items = quoteCrane.HiredItems == null ? 0 : quoteCrane.HiredItems;
                var hourPrice = _context.Cranes.SingleOrDefault(c => c.Id == quoteCrane.Crane_Id).PricePerHour;
                var itemPrice = _context.Cranes.SingleOrDefault(c => c.Id == quoteCrane.Crane_Id).PricePerItem;
                var priceHour = hourPrice * hours;
                var priceItems = itemPrice * items;
                quoteCrane.Price = (double)(priceHour + priceItems);
                total += (int)quoteCrane.Price;
            }
            var discount = quote.Discount == null ? 0 : quote.Discount;
            quote.Discount = discount;
            discount = discount / 100;
            var discountRate = total * discount;
            quote.Total = (double)(total - discountRate);

            _context.Quotes.Add(quote);
            _context.SaveChanges();

            var id = _context.Quotes.Max(q => q.Id);
            foreach (var quoteCrane in viewModel.QuoteCranes)
            {
                var quoteCraneObj = new QuoteCranes
                {
                    Quote_Id = id,
                    Crane_Id = quoteCrane.Crane_Id,
                    Price = quoteCrane.Price,
                    HiredHours = quoteCrane.HiredHours,
                    HiredItems = quoteCrane.HiredItems,
                };
                _context.QuoteCranes.Add(quoteCraneObj);
            }
            _context.SaveChanges();
            return Json(new { success = true, message = "Saved Successfully" }, JsonRequestBehavior.DenyGet);
        }
        //POST: Quotes/Edit
        [HttpPost]
        public JsonResult Edit(SaveQuoteViewModel viewModel)
        {
            var total = 0;
            var vQuote = viewModel.Quote;
            var vQuoteCranes = viewModel.QuoteCranes;
            var quoteInDB = _context.Quotes.SingleOrDefault(q => q.Id == vQuote.Id);
            if (quoteInDB == null)
                return Json(new { success = false, message = "No such Quotation In Database" });

            // Quote
            quoteInDB.Customer_Id = vQuote.Customer_Id;
            foreach (var quoteCrane in vQuoteCranes)
            {
                var hours = quoteCrane.HiredHours == null ? 0 : quoteCrane.HiredHours;
                var items = quoteCrane.HiredItems == null ? 0 : quoteCrane.HiredItems;
                var hourPrice = _context.Cranes.SingleOrDefault(c => c.Id == quoteCrane.Crane_Id).PricePerHour;
                var itemPrice = _context.Cranes.SingleOrDefault(c => c.Id == quoteCrane.Crane_Id).PricePerItem;
                var priceHour = hourPrice * hours;
                var priceItems = itemPrice * items;
                quoteCrane.Price = (double)(priceHour + priceItems);
                total += (int)quoteCrane.Price;
            }
            var discount = vQuote.Discount == null ? 0 : vQuote.Discount;
            vQuote.Discount = discount;
            discount = discount / 100;
            var discountRate = total * discount;
            vQuote.Total = (double)(total - discountRate);

            quoteInDB.Discount = vQuote.Discount;
            quoteInDB.Total = vQuote.Total;

            // QuoteCranes
            var qouteCranesInDb = _context.QuoteCranes.Where(c => c.Quote_Id == vQuote.Id);
            var myIds = vQuoteCranes.Select(x => x.Id).Distinct().ToList();
            var toBeDeleted = qouteCranesInDb.Where(x => !myIds.Contains(x.Id));
            if (toBeDeleted != null)
            {
                _context.QuoteCranes.RemoveRange(toBeDeleted);
            }

            foreach (var quoteCrane in vQuoteCranes)
            {
                // New
                if (quoteCrane.Id == 0)
                {
                    var quoteCraneObj = new QuoteCranes
                    {
                        Quote_Id = vQuote.Id,
                        Crane_Id = quoteCrane.Crane_Id,
                        Price = quoteCrane.Price,
                        HiredHours = quoteCrane.HiredHours,
                        HiredItems = quoteCrane.HiredItems,
                    };
                    _context.QuoteCranes.Add(quoteCraneObj);
                }
            }
            _context.SaveChanges();
            return Json(new { success = true, message = "Edited Successfully" });
        }

        //GET: Quotes/Proceed/5
        public ActionResult Proceed(int id)
        {
            return RedirectToAction("Create", "Receipts", new { id = id });
        }
    }
}