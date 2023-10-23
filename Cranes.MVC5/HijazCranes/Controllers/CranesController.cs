using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.IO;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using HijazCranes.Models;

namespace HijazCranes.Controllers
{
    public class CranesController : Controller
    {
        private readonly ApplicationDbContext _context;
        public CranesController()
        {
            _context = new ApplicationDbContext();
        }
        protected override void Dispose(bool disposing)
        {
            _context.Dispose();
        }
        // GET: Cranes
        public ActionResult Index()
        {
            return View(_context.Cranes.ToList());
        }

        // GET: Cranes/Details/5
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Crane crane = _context.Cranes.Find(id);
            if (crane == null)
            {
                return HttpNotFound();
            }
            return View(crane);
        }

        // GET: Cranes/Create
        public ActionResult Create()
        {
            return View();
        }
        // GET: Cranes/Edit/5
        public ActionResult Edit(int id)
        {
            var crane = _context.Cranes.SingleOrDefault(c => c.Id == id);
            if (crane == null)
            {
                return HttpNotFound();
            }
            return View(crane);
        }

        // POST: Cranes/Create
        // To protect from overposting attacks, enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        //[HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Save(Crane crane)
        {
            if (ModelState.IsValid)
            {
                if (crane.Id == 0)
                {
                    if (crane.ImageFile != null)
                    {
                        var fileName = Path.GetFileNameWithoutExtension(crane.ImageFile.FileName);
                        var exe = Path.GetExtension(crane.ImageFile.FileName);
                        fileName = crane.Id + DateTime.Now.ToString("yymmssff") + exe;
                        crane.Image = "~/Images/Cranes/" + fileName;
                        // Copy 
                        fileName = Path.Combine(Server.MapPath("~/Images/Cranes/"), fileName);
                        crane.ImageFile.SaveAs(fileName);
                    }
                    _context.Cranes.Add(crane);
                }
                else
                {
                    var craneInDb = _context.Cranes.SingleOrDefault(c => c.Id == crane.Id);
                    craneInDb.Name = crane.Name;
                    craneInDb.MaxWeightLiftInTon = crane.MaxWeightLiftInTon;
                    craneInDb.PricePerHour = crane.PricePerHour;
                    craneInDb.PricePerItem = crane.PricePerItem;
                    craneInDb.Plate = crane.Plate;
                    if (crane.ImageFile != null)
                    {
                        // Delete Image
                        var path = Server.MapPath(craneInDb.Image);
                        var fileToBeDelete = new FileInfo(path);
                        if (fileToBeDelete.Exists)
                        {
                            fileToBeDelete.Delete();
                        }

                        var fileName = Path.GetFileNameWithoutExtension(crane.ImageFile.FileName);
                        var exe = Path.GetExtension(crane.ImageFile.FileName);
                        fileName = crane.Id + DateTime.Now.ToString("yymmssff") + exe;
                        craneInDb.Image = "~/Images/Cranes/" + fileName;
                        // Copy 
                        fileName = Path.Combine(Server.MapPath("~/Images/Cranes/"), fileName);
                        crane.ImageFile.SaveAs(fileName);
                    }
                }
                _context.SaveChanges();
            }
            return RedirectToAction("Index", "Cranes");
        }
       
        // GET: Cranes/Delete/5
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Crane crane = _context.Cranes.Find(id);
            if (crane == null)
            {
                return HttpNotFound();
            }
            return View(crane);
        }

        // POST: Cranes/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            Crane crane = _context.Cranes.Find(id);
            var path = Server.MapPath(crane.Image);
            var fileToBeDelete = new FileInfo(path);
            if (fileToBeDelete.Exists)
            {
                fileToBeDelete.Delete();
            }
            _context.Cranes.Remove(crane);
            _context.SaveChanges();
            return RedirectToAction("Index");
        }
    }
}
