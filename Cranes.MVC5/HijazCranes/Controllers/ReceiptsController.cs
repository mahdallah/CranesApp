using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using HijazCranes.Models;
using HijazCranes.ViewModels;

namespace HijazCranes.Controllers
{
    public class ReceiptsController : Controller
    {
        private readonly ApplicationDbContext _context = new ApplicationDbContext();

        // GET: Receipts
        public ActionResult Index()
        {
            var receipts = _context.Receipts.Include(r => r.Customer).Include(r => r.Quote);
            return View(receipts.ToList());
        }

        // GET: Receipts/Details/5
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Receipt receipt = _context.Receipts.Find(id);
            if (receipt == null)
            {
                return HttpNotFound();
            }
            return View(receipt);
        }

        // GET: Receipts/Create
        public ActionResult Create(int id)
        {
            var quote = _context.Quotes.SingleOrDefault(q => q.Id == id);
            var employee = _context.Employees.SingleOrDefault(e => e.Id == quote.Employee_Id);
            var customer = _context.Customers.SingleOrDefault(e => e.Id == quote.Customer_Id);
            var quoteCranes = _context.QuoteCranes.Where(qc => qc.Quote_Id == id).Include(c => c.Crane).ToList();
            var accounts = _context.Accounts.ToList();
            var viewModel = new ReceiptViewModel 
            { 
                Quote = quote, 
                Employee = employee, 
                Customer = customer, 
                Accounts = accounts,
                QuoteCranes = quoteCranes 
            };
            ViewBag.Customer_Id = new SelectList(_context.Customers, "Id", "FirstName");
            ViewBag.Quote_Id = new SelectList(_context.Quotes, "Id", "Id");
            return View(viewModel);
        }

        // POST: Receipts/Create
        // To protect from overposting attacks, enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "Id,Paid,Remained,Quote_Id,Customer_Id,Created")] Receipt receipt)
        {
            if (ModelState.IsValid)
            {
                _context.Receipts.Add(receipt);
                _context.SaveChanges();
                return RedirectToAction("Index");
            }

            ViewBag.Customer_Id = new SelectList(_context.Customers, "Id", "FirstName", receipt.Customer_Id);
            ViewBag.Quote_Id = new SelectList(_context.Quotes, "Id", "Id", receipt.Quote_Id);
            return View(receipt);
        }

        // GET: Receipts/Edit/5
        public ActionResult Edit(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Receipt receipt = _context.Receipts.Find(id);
            if (receipt == null)
            {
                return HttpNotFound();
            }
            ViewBag.Customer_Id = new SelectList(_context.Customers, "Id", "FirstName", receipt.Customer_Id);
            ViewBag.Quote_Id = new SelectList(_context.Quotes, "Id", "Id", receipt.Quote_Id);
            return View(receipt);
        }

        // POST: Receipts/Edit/5
        // To protect from overposting attacks, enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "Id,Paid,Remained,Quote_Id,Customer_Id,Created")] Receipt receipt)
        {
            if (ModelState.IsValid)
            {
                _context.Entry(receipt).State = EntityState.Modified;
                _context.SaveChanges();
                return RedirectToAction("Index");
            }
            ViewBag.Customer_Id = new SelectList(_context.Customers, "Id", "FirstName", receipt.Customer_Id);
            ViewBag.Quote_Id = new SelectList(_context.Quotes, "Id", "Id", receipt.Quote_Id);
            return View(receipt);
        }

        // GET: Receipts/Delete/5
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Receipt receipt = _context.Receipts.Find(id);
            if (receipt == null)
            {
                return HttpNotFound();
            }
            return View(receipt);
        }

        // POST: Receipts/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            Receipt receipt = _context.Receipts.Find(id);
            _context.Receipts.Remove(receipt);
            _context.SaveChanges();
            return RedirectToAction("Index");
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                _context.Dispose();
            }
            base.Dispose(disposing);
        }
    }
}
